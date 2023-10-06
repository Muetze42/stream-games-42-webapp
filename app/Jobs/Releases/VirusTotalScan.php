<?php

namespace App\Jobs\Releases;

use App\Mail\Releases\PublishFailed;
use App\Mail\Releases\VirusScanFinished;
use App\Models\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use VirusTotal;

class VirusTotalScan implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Sleep in seconds between each VirusTotal API request.
     *
     * @var int
     */
    protected int $apiSleep = 20;

    /**
     * The Release instance.
     *
     * @var \App\Models\Release
     */
    protected Release $release;

    /**
     * Create a new job instance.
     */
    public function __construct(Release $release)
    {
        $this->release = $release;
    }

    /**
     * Execute the job.
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \NormanHuth\VirusTotal\Exceptions\VirusTotalApiException
     */
    public function handle(): void
    {
        set_time_limit(0);
        $filename = basename(trim($this->release->download_url, '/'));
        Storage::disk('temp')->put($filename, file_get_contents($this->release->download_url));
        $upload = VirusTotal::scanFile(Storage::disk('temp')->path($filename));
        $analysisId = $upload['data']['id'];
        $this->release->update(['virus_total_id' => $analysisId]);
        sleep($this->apiSleep);
        $this->analyseFile($analysisId);
        Storage::delete($filename);
    }

    /**
     * Check file analysis.
     *
     * @param string $analysisId
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function analyseFile(string $analysisId): void
    {
        $result = VirusTotal::analyseUrlOrFile($analysisId);
        $status = $result['data']['data']['attributes']['status'];

        if ($status != 'completed') {
            sleep($this->apiSleep);
            $this->analyseFile($analysisId);
            return;
        }

        $stats = $result['data']['data']['attributes']['stats'];
        $success = !$stats['harmless'] && !$stats['malicious'] && !$stats['suspicious'];

        $this->release->update([
            'active' => $success,
            'virus_total_stats' => $stats
        ]);

        Mail::to(config('mail.to'))->queue(new VirusScanFinished($this->release, $success));
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return 'release_' . $this->release->getKey();
    }
}

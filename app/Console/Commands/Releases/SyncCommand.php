<?php

namespace App\Console\Commands\Releases;

use App\Models\Release;
use Illuminate\Console\Command;
use App\Http\Clients\GitHub;

class SyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:releases:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize releases with GitHub API.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $batch = getBatch(Release::class);

        $releases = GitHub::listReleases();

        foreach ($releases as $release) {
            updateOrCreateRelease($release, $batch);
        }

        Release::where('batch', '<', $batch)->delete();
    }
}

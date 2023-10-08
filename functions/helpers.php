<?php

use App\Jobs\Releases\VirusTotalScan;
use App\Models\Release;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

if (!function_exists('clientEncrypt')) {
    /**
     * Encrypt the given value with specific crypt key.
     *
     * @param mixed  $value
     * @param string $key
     * @param bool   $serialize
     *
     * @return string
     */
    function clientEncrypt(mixed $value, string $key, bool $serialize = true): string
    {
        $key = Str::limit($key, 32, '');
        $encrypter = new Encrypter($key, config('app.cipher'));

        return $encrypter->encrypt($value, $serialize);
    }
}

if (!function_exists('clientDecrypt')) {
    /**
     * Encrypt the given value with specific crypt key.
     *
     * @param mixed  $value
     * @param string $key
     * @param bool   $serialize
     *
     * @return string
     */
    function clientDecrypt(mixed $value, string $key, bool $serialize = true): string
    {
        $key = Str::limit($key, 32, '');
        $encrypter = new Encrypter($key, config('app.cipher'));

        return $encrypter->decrypt($value, $serialize);
    }
}

if (!function_exists('getSetupExe')) {
    /**
     * Get Setup EXE from GitHub release response.
     *
     * @param array $assets
     *
     * @return string|null
     */
    function getSetupExe(array $assets): ?string
    {
        foreach ($assets as $asset) {
            if ($asset['state'] == 'uploaded' && str_ends_with($asset['browser_download_url'], 'setup.exe')) {
                return $asset['browser_download_url'];
            }
        }

        return null;
    }
}

if (!function_exists('errorImage')) {
    /**
     * Get an SVG by error code.
     *
     * @param int $errorCode
     * @return string
     */
    function errorImage(int $errorCode): string
    {
        $errorImages = [
            '401' => '403.svg',
            '403' => '403.svg',
            '404' => '404.svg',
            '500' => '503.svg',
        ];

        return $errorImages[$errorCode] ?? '404.svg';
    }
}

if (!function_exists('updateOrCreateRelease')) {
    /**
     * Create or update a record matching the attributes, and fill it with values from GitHub API response.
     *
     * @param array $data
     * @param int $batch
     * @return \Illuminate\Database\Eloquent\Model|\App\Models\Release
     */
    function updateOrCreateRelease(array $data, int $batch = 99999999): Model|Release
    {
        $release = Release::updateOrCreate(
            ['release_id' => $data['id']],
            [
                'name' => $data['name'],
                'body' => $data['body'],
                'tag' => $data['tag_name'],
                'download_url' => getSetupExe($data['assets']),
                'prerelease' => $data['prerelease'],
                'batch' => $batch,
                'published_at' => $data['published_at']
            ]
        );

        if ($release->download_url && !$release->virus_total_id) {
            VirusTotalScan::dispatch($release);
        }

        return $release;
    }
}

<?php

use Illuminate\Encryption\Encrypter;

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
        $downloadUrl = null;
        foreach ($assets as $asset) {
            if ($asset['state'] == 'uploaded' && str_ends_with($asset['browser_download_url'], 'setup.exe')) {
                $downloadUrl = $asset['browser_download_url'];
                break;
            }
        }

        return $downloadUrl;
    }
}

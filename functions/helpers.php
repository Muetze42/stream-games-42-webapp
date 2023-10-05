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

<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class GitHub
{
    /**
     * The GitHub API base uri.
     *
     * @var string
     */
    protected static string $baseUri = 'https://api.github.com';

    /**
     * @param string $path
     *
     * @return string
     */
    protected static function url(string $path): string
    {
        $replace = [
            '{owner}' => config('services.github.app.name'),
            '{repo}' => config('services.github.app.repository')
        ];

        $path = str_replace(array_keys($replace), array_values($replace), $path);

        return static::$baseUri . '/' . ltrim($path, '/');
    }

    /**
     * Create and send an HTTP GET request to the GitHub API.
     *
     * @param string $path
     *
     * @return array
     */
    protected static function get(string $path): array
    {
        return Http::withHeader('X-GitHub-Api-Version', '2022-11-28')
            ->get(static::url($path))
            ->json();
    }

    /**
     * This returns a list of releases, which does not include regular Git tags that have not been associated with a
     * release. To get a list of Git tags, use the Repository Tags API.
     *
     * @see https://docs.github.com/en/rest/releases/releases#list-releases
     *
     * @param int $page
     *
     * @return array{
     *     url: string,
     *     assets_url: string,
     *     upload_url: string,
     *     html_url: string,
     *     id: int,
     *     author: array,
     *     node_id: string,
     *     tag_name: string,
     *     target_commitish: string,
     *     name: string,
     *     draft: bool,
     *     prerelease: bool,
     *     created_at: string,
     *     published_at: string,
     *     tarball_url: string,
     *     zipball_url: string,
     *     body: string,
     *     assets: array{
     *          url: string,
     *          id: int,
     *          node_id: string,
     *          uploader: array,
     *          content_type: string,
     *          state: string,
     *          size: int,
     *          download_count: int,
     *          created_at: string,
     *          updated_at: string,
     *          browser_download_url: string
     *     }
     * }
     */
    public static function listReleases(int $page = 1): array
    {
        return static::get('repos/{owner}/{repo}/releases?per_page=100&page=' . $page);
    }
}

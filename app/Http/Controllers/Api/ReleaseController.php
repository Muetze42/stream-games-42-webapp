<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Release;

class ReleaseController extends Controller
{
    /**
     * The needed release columns.
     *
     * @var array<string>
     */
    protected array $columns = [
        'tag',
        'download_url',
        'published_at',
    ];

    /**
     * Get current stable and beta release.
     *
     * @return array
     */
    public function index(): array
    {
        $stable = Release::where('tag', 'not like', '%-%')
            ->whereNotNull('download_url')
            ->orderByDesc('published_at')
            ->first($this->columns);

        $beta = Release::where('tag', 'like', '%-beta%')
            ->whereNotNull('download_url')
            ->orderByDesc('published_at');

        if ($stable) {
            $beta->where('published_at', '>', $stable->published_at);
        }

        return array_filter([
            'stable' => $stable,
            'beta' => $beta->first($this->columns)
        ]);
    }
}

<?php

namespace App\Models;

use App\Traits\Models\CanBeActiveTrait;
use Illuminate\Database\Eloquent\Model;
use NormanHuth\HelpersLaravel\Traits\Models\HasBatchTrait;

class Release extends Model
{
    use HasBatchTrait;
    use CanBeActiveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'release_id',
        'name',
        'body',
        'tag',
        'download_url',
        'file_hashes',
        'virus_total_id',
        'virus_total_stats',
        'prerelease',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_id' => 'int',
        'virus_total_stats' => 'array',
        'virus_total_file_hashesstats' => 'array',
        'prerelease' => 'bool',
        'published_at' => 'datetime',
    ];
}

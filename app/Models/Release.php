<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NormanHuth\HelpersLaravel\Traits\Models\HasBatchTrait;

class Release extends Model
{
    use HasBatchTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'release_id',
        'tag',
        'download_url',
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
        'prerelease' => 'bool',
        'published_at' => 'datetime',
    ];
}

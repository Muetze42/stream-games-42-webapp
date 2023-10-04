<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannedUser extends Model
{
    use SoftDeletes;

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    public const CREATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'broadcaster_id',
        'user_id',
        'moderator_id',
        'reason',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'broadcaster_id' => 'int',
        'user_id' => 'int',
        'moderator_id' => 'int',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that owns the blocked user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, BannedUser::class);
    }
}

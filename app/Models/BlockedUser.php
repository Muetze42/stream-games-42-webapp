<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockedUser extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'broadcaster_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'broadcaster_id' => 'int',
        'user_id' => 'int',
    ];

    /**
     * Get the user that owns the banned user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, BannedUser::class);
    }
}

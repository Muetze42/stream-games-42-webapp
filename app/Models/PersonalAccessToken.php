<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'client',
        'token',
        'abilities',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'client',
        'token',
    ];

    /**
     * Find the token instance matching the given token.
     *
     * @param  string  $token
     * @return static|null
     */
    public static function findToken($token): null|static
    {
        $client = request()->header('machineId');

        if (!str_contains($token, '|')) {
            return static::where('token', hash('sha256', $token))->where('client', $client)->first();
        }

        [$id, $token] = explode('|', $token, 2);

        /* @var self $instance */
        if ($instance = static::where('id', $id)->where('client', $client)->first()) {
            return hash_equals($instance->token, hash('sha256', $token)) ? $instance : null;
        }

        return null;
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function (self $token) {
            $token->client = request()->header('machineId');
        });
    }
}

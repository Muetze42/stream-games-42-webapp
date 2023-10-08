<?php

namespace App\Models;

use App\Traits\Models\CanConnectTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use CanConnectTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'twitch_id',
        'name',
        'login',
        'email',
        'token',
        'refresh_token',
        'scopes',
        'token_refreshed_at',
        'token_validated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email',
        'remember_token',
        'token',
        'refresh_token',
        'scopes',
        'token_refreshed_at',
        'token_validated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'twitch_id' => 'string',
        'password' => 'hashed',
        'token' => 'encrypted',
        'refresh_token' => 'encrypted',
        'scopes' => 'array',
        'token_refreshed_at' => 'datetime',
        'token_validated_at' => 'datetime',
    ];

    /**
     * Create a new personal access token for the user.
     *
     * @param string                  $name
     * @param array                   $abilities
     * @param \DateTimeInterface|null $expiresAt
     *
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(
        string $name,
        array $abilities = ['*'],
        DateTimeInterface $expiresAt = null
    ): NewAccessToken {
        $plainTextToken = sprintf(
            '%s%s%s',
            config('sanctum.token_prefix', ''),
            $tokenEntropy = Str::random(40),
            hash('crc32b', $tokenEntropy)
        );

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }

    /**
     * Create a new personal access token for the user.
     *
     * @param string                  $name
     * @param string                  $client
     * @param string                  $platform
     * @param array                   $abilities
     * @param \DateTimeInterface|null $expiresAt
     *
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createFilledToken(
        string $name,
        string $client,
        string $platform,
        array $abilities = ['*'],
        DateTimeInterface $expiresAt = null
    ): NewAccessToken {
        $plainTextToken = sprintf(
            '%s%s%s',
            config('sanctum.token_prefix', ''),
            $tokenEntropy = Str::random(40),
            hash('crc32b', $tokenEntropy)
        );

        $token = $this->tokens()->create([
            'name' => $name,
            'client' => $client,
            'platform' => $platform,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }

    /**
     * Get the settings for the user.
     */
    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }
}

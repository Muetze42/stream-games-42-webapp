<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class ConnectionAttempt extends Model
{
    use HasUuids;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    public const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['data'];

    /**
     * The attributes that should be D.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'encrypted:array',
        'token' => 'encrypted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ip_hash',
        'uri',
        'token',
        'data',
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['id', 'token'];
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function (self $attempt) {
            $attempt->uri = str(Str::random())->lower();
            $attempt->ip_hash = md5(request()->ip());
        });
    }

    /**
     * Get the parent authenticatable model.
     */
    public function authenticatable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Set the parent authenticatable model.
     *
     * @param \Illuminate\Database\Eloquent\Model|null $authenticatable
     *
     * @return void
     */
    public function setUser(?Model $authenticatable): void
    {
        $this->authenticatable()->associate($authenticatable)->save();
    }
}

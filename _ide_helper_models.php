<?php

// @formatter:off
// phpcs:ignore
// phpcs:disable

/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property string|null $log_name
 * @property string $description
 * @property string|null $subject_type
 * @property int|null $subject_id
 * @property string|null $event
 * @property string|null $causer_type
 * @property int|null $causer_id
 * @property \Illuminate\Support\Collection|null $properties
 * @property string|null $batch_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $causer
 * @property-read \Illuminate\Support\Collection $changes
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @method static \Illuminate\Database\Eloquent\Builder|Activity causedBy(\Illuminate\Database\Eloquent\Model $causer)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forBatch(string $batchUuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forEvent(string $event)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forSubject(\Illuminate\Database\Eloquent\Model $subject)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity hasBatch()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity inLog(...$logNames)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereBatchUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withoutTrashed()
 */
    class Activity extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\ConnectionAttempt
 *
 * @property string $id
 * @property string|null $authenticatable_type
 * @property int|null $authenticatable_id
 * @property string|null $ip_hash
 * @property string|null $uri
 * @property mixed|null $token
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $authenticatable
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereAuthenticatableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereAuthenticatableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereIpHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConnectionAttempt whereUri($value)
 */
    class ConnectionAttempt extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\PersonalAccessToken
 *
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string|null $client
 * @property string|null $platform
 * @property string $token
 * @property array|null $abilities
 * @property \Illuminate\Support\Carbon|null $last_used_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $tokenable
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereAbilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereTokenableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereTokenableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereUpdatedAt($value)
 */
    class PersonalAccessToken extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Release
 *
 * @property int $id
 * @property int $release_id
 * @property string|null $name
 * @property string|null $body
 * @property string $tag
 * @property string|null $download_url
 * @property string|null $virus_total_id
 * @property array|null $virus_total_stats
 * @property mixed|null $file_hashes
 * @property bool $prerelease
 * @property int $active
 * @property int $batch
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Release active()
 * @method static \Illuminate\Database\Eloquent\Builder|Release newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Release newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Release query()
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereDownloadUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereFileHashes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release wherePrerelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereReleaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereVirusTotalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereVirusTotalStats($value)
 */
    class Release extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting withoutTrashed()
 */
    class Setting extends \Eloquent
    {
    }
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $twitch_id
 * @property string $name
 * @property string|null $login
 * @property string|null $email
 * @property mixed|null $token
 * @property mixed|null $refresh_token
 * @property string|null $remember_token
 * @property array|null $scopes
 * @property \Illuminate\Support\Carbon|null $token_refreshed_at
 * @property \Illuminate\Support\Carbon|null $token_validated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $password
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConnectionAttempt> $connectionAttempts
 * @property-read int|null $connection_attempts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Setting> $settings
 * @property-read int|null $settings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTokenRefreshedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTokenValidatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
    class User extends \Eloquent
    {
    }
}

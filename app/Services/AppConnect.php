<?php

namespace App\Services;

use App\Models\ConnectionAttempt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class AppConnect
{
    /**
     * Get the ID, token and uri for a connection attempt.
     *
     * @param array                                 $data
     * @param \Illuminate\Foundation\Auth\User|null $authenticatable
     *
     * @return \App\Models\ConnectionAttempt
     */
    public static function create(array $data = [], ?Authenticatable $authenticatable = null): mixed
    {
        /* @var \Illuminate\Foundation\Auth\User|\App\Traits\Models\CanConnectTrait $authenticatable */
        if ($authenticatable) {
            return $authenticatable->connectionAttempts()->create(['data' => $data]);
        }

        return ConnectionAttempt::create(['data' => $data]);
    }

    /**
     * Build a query for a ConnectionAttempt.
     *
     * @param \App\Models\ConnectionAttempt $attempt
     * @param \Illuminate\Http\Request|null $request
     * @param string                        $id
     * @param string                        $uri
     * @param bool                          $validate
     *
     * @return \App\Models\ConnectionAttempt|null
     */
    protected static function query(
        ConnectionAttempt $attempt,
        ?Request $request,
        string $id,
        string $uri,
        bool $validate = true
    ): ConnectionAttempt|null {
        /* @var \App\Models\ConnectionAttempt|\Illuminate\Database\Eloquent\Builder $attempt */
        $attempt = $attempt
            ->whereId($id)
            ->whereUri($uri)
            ->when(
                $validate && $request,
                function (ConnectionAttempt|Builder $query) use ($request) {
                    $query->whereClient($request->header('machineId'));
                }
            )
            ->when(
                $validate && $request,
                function (ConnectionAttempt|Builder $query) use ($request) {
                    $query->wherePlatform($request->header('plattform'));
                }
            );

        if ($duration = config('app-connector.connection-attempt-duration')) {
            $attempt->where('created_at', '>=', now()->subMinutes($duration));
        }

        return $attempt->first();
    }

    /**
     * Verifying that a connection attempt is valid.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $id
     * @param string                   $token
     * @param string                   $uri
     *
     * @return bool
     */
    public static function isValid(Request $request, string $id, string $token, string $uri): bool
    {
        $attempt = static::query(new ConnectionAttempt(), $request, $id, $uri);

        return !is_null($attempt) && $attempt->token === $token;
    }

    /**
     * Get ConnectionAttempt Eloquent Object if connection attempt exists and is valid.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $id
     * @param string                   $token
     * @param string                   $uri
     *
     * @return \App\Models\ConnectionAttempt|null
     */
    public static function get(
        Request $request,
        string $id,
        string $token,
        string $uri
    ): ?ConnectionAttempt {
        /* @var \App\Models\ConnectionAttempt $model */
        $attempt = static::query(new ConnectionAttempt(), $request, $id, $uri);

        return !is_null($attempt) && $attempt->token === $token ?
            $attempt : null;
    }
}

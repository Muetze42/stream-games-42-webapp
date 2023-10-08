<?php

namespace App\Traits\Models;

use App\Models\ConnectionAttempt;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait CanConnectTrait
{
    /**
     * Get all the connection attempts of the authenticatable model.
     */
    public function connectionAttempts(): MorphMany
    {
        return $this->morphMany(ConnectionAttempt::class, 'authenticatable');
    }
}

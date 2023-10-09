<?php

namespace App\Http\Controllers\Api\External;

use App\Http\Controllers\Controller;
use App\Services\AppConnectAttempts;

class AuthController extends Controller
{
    /**
     * Create a new connection attempt.
     *
     * @return \App\Models\ConnectionAttempt
     */
    public function create()
    {
        return AppConnectAttempts::create();
    }
}

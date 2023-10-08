<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Services\AppConnect;

class AuthController extends Controller
{
    /**
     * Create a new connection attempt.
     *
     * @return \App\Models\ConnectionAttempt
     */
    public function create()
    {
        return AppConnect::create();
    }
}

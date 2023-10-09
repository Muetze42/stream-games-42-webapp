<?php

namespace App\Http\Controllers\External;

use App\Services\AppConnectAttempts;

class AuthAbstractController extends AbstractController
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

<?php

namespace App\Http\Controllers\Api\External;

use Illuminate\Http\Request;

class UserController extends AbstractController
{
    /**
     * Display the authenticated user resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\User|mixed
     */
    public function show(Request $request)
    {
        return $request->user()->only(['id', 'name']);
    }
}

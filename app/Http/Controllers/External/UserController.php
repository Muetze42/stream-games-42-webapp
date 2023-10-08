<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
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

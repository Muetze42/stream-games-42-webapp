<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return \NormanHuth\StreamGames42\Services\AppConnector::getAttempt();
        return \NormanHuth\StreamGames42\Models\ConnectionAttempt::create();

        return Inertia::render('Home/Index');
    }
}

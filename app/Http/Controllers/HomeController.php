<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends AbstractController
{
    /**
     * Display the homepage.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home/Index');
    }
}

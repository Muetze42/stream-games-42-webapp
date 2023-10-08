<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $array = [
            'data' => ['required', 'json'],
            'name' => ['string', 'nullable']
        ];

        return array_keys($array);

        $user = User::find(2);

        $user->settings()->updateOrCreate(
            ['name' => 's'],
            [
                'data' => [
                    'foo' => $user->name
                ]
            ]
        );

        return Inertia::render('Home/Index');
    }
}

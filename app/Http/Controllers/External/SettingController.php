<?php

namespace App\Http\Controllers\External;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Setting::class, 'setting');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->user()->settings()->get(static::INDEX_COLUMNS);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(static::VALIDATION_RULES);

        $request->user()
            ->settings()
            ->create($request->only(array_keys(static::VALIDATION_RULES)));

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return $setting->makeHidden(static::HIDDEN_COLUMNS);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate(static::VALIDATION_RULES);

        $setting->update($request->only(array_keys(static::VALIDATION_RULES)));

        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return true;
    }
}

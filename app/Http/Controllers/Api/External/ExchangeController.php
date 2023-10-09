<?php

namespace App\Http\Controllers\Api\External;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExchangeController extends Controller
{
    /**
     * Execute the index query with this "select" statement.
     *
     * @var array
     */
    protected array $indexColumns = ['name', 'created_at', 'updated_at'];

    /**
     * Execute the show query with this "select" statement.
     *
     * @var array
     */
    protected array $hiddenColumns = ['user_id', 'deleted_at'];

    /**
     * The default validation rules for the API concept.
     *
     * @var array
     */
    protected array $validationRules = [
        'data' => ['required', 'json'],
        'name' => ['string', 'nullable']
    ];

    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $action = getRouteAction(request());
        $model = Str::studly(Str::singular($action));

        $this->authorizeResource('\\App\\Models\\' . $model, Str::snake($model));
    }

    /**
     * The Controller Model for authorization.
     *
     * @var string|null
     */
    protected ?string $model = Setting::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->user()->settings()->get($this->indexColumns);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $request->user()
            ->settings()
            ->create($request->only(array_keys($this->validationRules)));

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return $setting->makeHidden($this->hiddenColumns);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate($this->validationRules);

        $setting->update($request->only(array_keys($this->validationRules)));

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

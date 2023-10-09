<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

abstract class AbstractController extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * The Controller Model for authorization.
     *
     * @var string|null
     */
    protected ?string $model = null;

    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        if ($this->model) {
            $this->authorizeResource($this->model, Str::snake(class_basename($this->model)));
        }
    }
}

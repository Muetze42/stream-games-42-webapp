<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Execute the index query with this "select" statement.
     *
     * @var array
     */
    protected const INDEX_COLUMNS = ['name', 'created_at', 'updated_at'];

    /**
     * Execute the show query with this "select" statement.
     *
     * @var array
     */
    protected const HIDDEN_COLUMNS = ['user_id', 'deleted_at'];

    /**
     * The default validation rules for the API concept.
     *
     * @var array
     */
    protected const VALIDATION_RULES = [
        'data' => ['required', 'json'],
        'name' => ['string', 'nullable']
    ];
}

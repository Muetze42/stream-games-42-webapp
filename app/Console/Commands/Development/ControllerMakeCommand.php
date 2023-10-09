<?php

namespace App\Console\Commands\Development;

use Illuminate\Routing\Console\ControllerMakeCommand as Command;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;

class ControllerMakeCommand extends Command
{
    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput(): string
    {
        if ($this->option('api') && !str_contains($this->argument('name'), '\\')) {
            return 'Api\\External\\' . trim($this->argument('name'));
        }

        return trim($this->argument('name'));
    }

    /**
     * Build the model replacement values.
     *
     * @param array $replace
     *
     * @return array
     */
    protected function buildModelReplacements(array $replace): array
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (
            !class_exists($modelClass) &&
            confirm("A {$modelClass} model does not exist. Do you want to generate it?", default: true)
        ) {
            $this->call('make:model', ['name' => $modelClass]);
        }

        $replace = $this->buildFormRequestReplacements($replace, $modelClass);

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            '{{ namespacedModel }}' => $modelClass,
            '{{namespacedModel}}' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            '{{ model }}' => class_basename($modelClass),
            '{{model}}' => class_basename($modelClass),
            '{{ modelParameter }}' => Str::snake(class_basename($modelClass)),
            '{{modelParameter}}' => Str::snake(class_basename($modelClass)),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
            '{{ modelVariable }}' => lcfirst(class_basename($modelClass)),
            '{{modelVariable}}' => lcfirst(class_basename($modelClass)),
            '{{ relationMethod }}' => Str::camel(Str::plural(class_basename($modelClass))),
            '{{relationMethod}}' => Str::camel(Str::plural(class_basename($modelClass))),
        ]);
    }
}

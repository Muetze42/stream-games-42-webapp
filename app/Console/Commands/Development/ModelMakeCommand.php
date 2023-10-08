<?php

namespace App\Console\Commands\Development;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;
use Illuminate\Support\Str;

class ModelMakeCommand extends Command
{
    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        return $this->replaceParameter($stub, $name);
    }

    /**
     * Replace the resource action parameter for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceParameter(string $stub, string $name): string
    {
        $parameter = Str::kebab(str_replace($this->getNamespace($name) . '\\', '', $name));

        return str_replace(['{{ modelParameter }}', '{{modelParameter}}'], $parameter, $stub);
    }
}

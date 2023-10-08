<?php

namespace App\Providers;

use App\Console\Commands\Development\MigrateMakeCommand;
use App\Models\PersonalAccessToken;
use App\Services\MigrationCreator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerMigrateMakeCommand();
        $this->registerCreator();
        $this->registerCarbonMacros();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        JsonResource::withoutWrapping();
    }

    /**
     * Register Carbon macros.
     *
     * @return void
     */
    protected function registerCarbonMacros(): void
    {
        Carbon::macro('toDefaultNameString', function (): string {
            return $this->rawFormat('Y-m-d H:i:s T');
        });
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator(): void
    {
        $this->app->singleton('migration.creator', function ($app) {
            return new MigrationCreator($app['files'], $app->basePath('stubs'));
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateMakeCommand(): void
    {
        $this->app->singleton(MigrateMakeCommand::class, function (Application $app) {
            $creator = new MigrationCreator($app['files'], $app->basePath('stubs'));

            $composer = $app['composer'];

            return new MigrateMakeCommand($creator, $composer);
        });
    }
}

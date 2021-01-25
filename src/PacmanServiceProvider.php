<?php

namespace SAR\ModuleCommands;

use Illuminate\Support\ServiceProvider;
use SAR\ModuleCommands\Console\Commands\MakeModule;
use SAR\ModuleCommands\Console\Commands\MakeModuleComponent;
use SAR\ModuleCommands\Console\Commands\MakeModuleController;
use SAR\ModuleCommands\Console\Commands\MakeModuleMigration;
use SAR\ModuleCommands\Console\Commands\MakeModuleModel;
use SAR\ModuleCommands\Console\Commands\MakeModuleObserver;
use SAR\ModuleCommands\Console\Commands\MakeModuleProvider;
use SAR\ModuleCommands\Console\Commands\MakeModuleRequest;
use SAR\ModuleCommands\Console\Commands\MakeModuleSeeder;

class PacmanServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeModule::class,
                MakeModuleController::class,
                MakeModuleMigration::class,
                MakeModuleModel::class,
                MakeModuleSeeder::class,
                MakeModuleComponent::class,
                MakeModuleObserver::class,
                MakeModuleRequest::class,
                MakeModuleProvider::class
            ]);
        }

        $this->publishes([
            __DIR__ . '/config/module-commands.php' => config_path('module-commands.php'),
        ], 'module-commands');
    }
}

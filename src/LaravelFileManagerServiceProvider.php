<?php

namespace zobayer\LaravelFileManager;

use Illuminate\Support\ServiceProvider;
use zobayer\LaravelFileManager\Console\FileManagerCommand;

class LaravelFileManagerServiceProvider extends ServiceProvider
{

    public function boot(){
        if ($this->app->runningInConsole()) {
            $this->commands([
                FileManagerCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/config/filemanager.php' => config_path('filemanager.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');


    }

    public function register(){

        $this->mergeConfigFrom(
            __DIR__.'/config/filemanager.php', 'filemanager'
        );
    }

}

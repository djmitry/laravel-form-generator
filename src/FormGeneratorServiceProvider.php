<?php

namespace Djmitry\Generator;

use Illuminate\Support\ServiceProvider;
use App;
use Blade;

class FormGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * Консольные комманды
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                FormGeneratorCommand::class,
            ]);
        }
    }
 
    public function register()
    {

    }
}
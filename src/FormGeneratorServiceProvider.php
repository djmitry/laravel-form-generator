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
         * Регистрируем консольные комманды
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                FormGeneratorCommand::class,
            ]);
        }
    }
 
    public function register()
    {
        /*App::singleton('widget', function(){
            return new \Djmitry\Widgets\Widget();
        });*/
    }
}
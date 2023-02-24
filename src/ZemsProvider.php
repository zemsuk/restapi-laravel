<?php

namespace Zems\Crudapi;

use Illuminate\Support\ServiceProvider;

class ZemsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->LoadViewsFrom(__DIR__.'/views', 'crudapi');
        $this->app->singleton(ZemsController::class, function(){
            return new ZemsController();
        });
        // $this->app->singleton('router', Router::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__.'/Router.php');
        // dd("Hi from Zems Package");
    }
}

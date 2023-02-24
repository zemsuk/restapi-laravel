<?php 
namespace Zems\Crudapi;

class Router 
//extends \Illuminate\Routing\Router
{
    public function myr() {
        // echo 'Hello myr';
        Route::group(['prefix' => 'gt'], function () { 
            Route::get('/hello', function () {
                return view('welcome');
            });  
        });
    }
}
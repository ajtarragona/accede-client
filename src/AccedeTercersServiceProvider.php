<?php

namespace Ajtarragona\AccedeTercers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Blade;
//use Illuminate\Support\Facades\Schema;

class AccedeTercersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');


        $config = __DIR__.'/Config/accede-tercers.php';
        
        $this->publishes([
            $config => config_path('accede-tercers.php'),
        ], 'ajtarragona-accede-tercers');


        $this->mergeConfigFrom($config, 'accede-tercers');
       
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       	
       	

        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}

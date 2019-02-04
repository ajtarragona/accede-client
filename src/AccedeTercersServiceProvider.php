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
        
        //cargo rutas
        $this->loadRoutesFrom(__DIR__.'/routes.php');


        //publico configuracion
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
       	

        //defino facade
       	$this->app->bind('accedetercers', function(){
            return new \Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;
        });


        //helpers
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}

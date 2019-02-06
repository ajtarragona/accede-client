<?php

namespace Ajtarragona\Accede;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Blade;
//use Illuminate\Support\Facades\Schema;

class AccedeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        //vistas
        $this->loadViewsFrom(__DIR__.'/resources/views', 'accede-client');
        
        //cargo rutas
        $this->loadRoutesFrom(__DIR__.'/routes.php');


        //publico configuracion
        $config = __DIR__.'/Config/accede.php';
        
        $this->publishes([
            $config => config_path('accede.php'),
        ], 'ajtarragona-accede');


        $this->mergeConfigFrom($config, 'accede');
       
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       	

        //defino facades
        $this->app->bind('accedetercers', function(){
            return new \Ajtarragona\Accede\Models\AccedeTercersProvider;
        });
        
       	$this->app->bind('accedevialer', function(){
            return new \Ajtarragona\Accede\Models\AccedeVialerProvider;
        });


        //helpers
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}

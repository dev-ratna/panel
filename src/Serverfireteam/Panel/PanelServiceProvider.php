<?php namespace Serverfireteam\Panel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;

class PanelServiceProvider extends ServiceProvider
{
    protected $defer = false;
        
    public function register()
    {
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');            
    }
        
    public function boot()
    {
        $this->package('serverfireteam/panel');
            
        Route::get('/panel/{entity}/all', function ($entity) {
            $controller = \App::make('Serverfireteam\\Panel\\'.$entity.'Controller');
            return $controller->callAction('all', array('entity' => $entity));
        });
    
        Route::any('/panel2/{entity}/edit', function ($entity) {
            $controller = \App::make('Serverfireteam\\Panel\\'.$entity.'Controller');
            return $controller->callAction('edit', array('entity' => $entity));
        });
           
                                                 
        include __DIR__."/../../routes.php";

        AliasLoader::getInstance()->alias('Serverfireteam', 'Serverfireteam\Panel\Serverfireteam');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}

<?php


namespace TenetUp\Zarinpal;


use Illuminate\Support\ServiceProvider;
use TenetUp\Zarinpal\Controller\Zarinpal;

class ZarinpalServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('zarinpal' , function (){
            return new Zarinpal;
        });
        $this->mergeConfigFrom(__DIR__ . '/config.php' , 'zarinpal');
    }
    public function boot(){
        $this->publishes([
            __DIR__.'/config.php' => config_path('zarinpal.php'),
        ]);
    }
}

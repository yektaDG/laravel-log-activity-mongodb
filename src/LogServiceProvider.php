<?php

namespace Yektadg\LaravelLogActivityMongodb;

use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
 
    $this->publishes([
        __DIR__.'/../config/database.php' => config_path('database.php'),
    ], 'config');
    
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'logpackage');

    if (file_exists($file = app_path('src/helpers.php'))) { 
        require $file;
    } 

  }
}
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
    $this->mergeConfigFrom(__DIR__.'/../config/mongodb.php', 'database.connections');
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'logpackage');

    if (file_exists($file = app_path('src/helpers.php'))) { 
        require $file;
    } 

  }
}
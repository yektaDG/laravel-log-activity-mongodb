<?php

namespace YektaDG\LaravelLogActivityMongodb;

use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'logpackage');

    // if 'src/helpers.php' does not work, try with 'helpers.php'
    if (file_exists($file = app_path('src/helpers.php'))) { 
        require $file;
    } 

  }
}
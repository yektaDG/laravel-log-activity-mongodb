<?php

namespace YektaDG\LaravelLogActivityMongodb;

use Illuminate\Support\ServiceProvider;

class BlogPackageServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    // $this->loadViewsFrom(__DIR__.'/../resources/views', 'blogpackage');
  }
}
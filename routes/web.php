<?php

use Illuminate\Support\Facades\Route;
use Yektadg\LaravelLogActivityMongodb\Http\Controllers\LogController;


Route::get('/logs', [LogController::class, 'index'])->name('log.index');

<?php

namespace Yektadg\LaravelLogActivityMongodb\Http\Controllers;

use Yektadg\LaravelLogActivityMongodb\Models\Log;


class LogController extends Controller
{

    public function index()
    {
        $logs = Log::all();
        return view('logpackage::logs.index', compact('logs')); 
    }

}

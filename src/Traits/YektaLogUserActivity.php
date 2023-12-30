<?php
namespace Yektadg\LaravelLogActivityMongodb\Traits;
use Yektadg\LaravelLogActivityMongodb\Models\Log;

trait YektaLogUserActivity{

    public static function bootYektaLogUserActivity()
    {
        static::created(function ($user) {
            $device = getInfoDevice();
            $log = Log::create([
                'user_id' => $user->id,
                'action' => 'register',
                'device_info' => $device,
            ]);
        });

        // Listen for the login event
        static::login(function ($user) {
            $device = getInfoDevice(); 
            $log = Log::create([
                'user_id' => $user->id,
                'action' => 'login',
                'device_info' => $device,
            ]);
        });

        // Listen for the logout event
        static::logout(function ($user) {
            $device = getInfoDevice(); 
            $log = Log::create([
                'user_id' => $user->id,
                'action' => 'logout',
                'device_info' => $device,
            ]);
        });
    }
}
<?php
namespace Yektadg\LaravelLogActivityMongodb\Traits;
use Yektadg\LaravelLogActivityMongodb\Models\Log;

trait YektaLog{

    public static function bootYektaLog()
    {
        static::created(function ($instance) {
            $device=getInfoDevice();
            $toSave = $instance->replicate();
            // $toSave->logable = $instance->log;
            $log = Log::create(
                [
                    'logable_id' => $instance->id, // id of object that loged on it
                    'logable_type' => get_class($instance), // type of object
                    'log_name' => 'default',
                    'user_id' =>  auth()->user()->id, // id of user who cused of log
                    'action' =>  Log::ACTION_CREATE,
                    'data' =>  json_encode($toSave),
                    'ip'=>$device['ip'],
                    'os'=>$device['os'],
                    'browser'=>$device['browser'],
                    'info'=>$device['info'],
                    'route'=> $instance->getShowRoute(),
                ]
            );
            foreach($instance->getForeignKeys() as $key=>$foreign_key){
                $parent = New $key;
                $temp =explode("\\", get_class($instance));
                Log::create(
                    [
                        'logable_id' => $instance->$foreign_key,
                        'logable_type' => get_class($parent),
                        'log_name' => 'default',
                        'user_id' =>  auth()->user()->id,
                        'action'=>  Log::ACTION_CREATE_CHILD,
                        'data' =>  json_encode([end($temp) => $log->id]),
                        'ip'=>$device['ip'],
                        'os'=>$device['os'],
                        'browser'=>$device['browser'],
                        'info'=>$device['info'],
                        'route'=> $parent->getShowRoute(),
                    ]
                );
            }
        });

        static::deleted(function ($instance) {

            $toSave = $instance->replicate();
            // $toSave->logable = $instance->log;
            $device=getInfoDevice();
            $log = Log::create([
                'logable_type' => get_class($instance),
                'logable_id' => $instance->id,
                'log_name' => 'default',
                'user_id' => auth()->user()->id,
                'action' => Log::ACTION_DELETE,
                'data' => json_encode($toSave),
                'ip'=>$device['ip'],
                'os'=>$device['os'],
                'browser'=>$device['browser'],
                'info'=>$device['info'],
                'route'=> $instance->getShowRoute(),
            ]);

            // dd($instance->getForeignKeys());
            foreach($instance->getForeignKeys() as $key=>$foreign_key){
                $parent = New $key;
                $temp =explode("\\", get_class($instance));
                Log::create(
                    [
                        'logable_id' => $instance->$foreign_key,
                        'logable_type' => get_class($parent),
                        'log_name' => 'default',
                        'user_id' =>  auth()->user()->id,
                        'action' =>  Log::ACTION_DELETE_CHILD,
                        'data' =>  json_encode([end($temp) => $log->id]),
                        'ip'=>$device['ip'],
                        'os'=>$device['os'],
                        'browser'=>$device['browser'],
                        'info'=>$device['info'],
                        'route'=> $parent->getShowRoute(),
                    ]
                );
            }
        });

        static::updated(function ($instance) {
            $toSave = [];
            $original = $instance->getOriginal();
            $changes = $instance->getChanges();
            $toSave = ['original' => $original, 'changes' => $changes];
            $device=getInfoDevice();
            $log = Log::create(
                [
                    'logable_id' => $instance->id,
                    'logable_type' => get_class($instance),
                    'log_name' => 'default',
                    'user_id' =>  auth()->user()->id,
                    'action' =>  Log::ACTION_EDIT,
                    'data' =>  json_encode($toSave),
                    'ip'=>$device['ip'],
                    'os'=>$device['os'],
                    'browser'=>$device['browser'],
                    'info'=>$device['info'],  
                    // const url = encodeURI(${process.env.NEXT_PUBLIC_BACKEND_URL}/api/organizations/get-by-slug?org=${slug})
                    // 'route'=> json_encode("route('admin.user.show' , '9876a6df-5268-4be5-9df4-25b19dc5fadc')")
                    'route'=> $instance->getShowRoute(),
                ]
            );
            foreach($instance->getForeignKeys() as $key=>$foreign_key){
                $parent = New $key;
                $temp =explode("\\", get_class($instance));
                Log::create(
                    [
                        'logable_id' => $instance->$foreign_key,
                        'logable_type' => get_class($parent),
                        'log_name' => 'default',
                        'user_id' =>  auth()->user()->id,
                        'action' =>  Log::ACTION_EDIT_CHILD,
                        'data' =>  json_encode([end($temp) => $log->id]),
                        'ip'=>$device['ip'],
                        'os'=>$device['os'],
                        'browser'=>$device['browser'],
                        'info'=>$device['info'],
                        'route'=> "test",
                        // 'route'=> $parent->getShowRoute(),
                    ]
                );
            }
        });

    }
}
<?php

namespace Yektadg\LaravelLogActivityMongodb\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','logable_id', 'logable_type', 'log_name' , 'uer_id', 'action', 'ip', 'os', 'browser', 'info' , 'data' , 'route'];
    protected $connection = 'mongodb';


    const ACTION_CREATE = 'create';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';

    const ACTION_CREATE_CHILD = 'assignment';
    const ACTION_EDIT_CHILD = 'reassignment';
    const ACTION_DELETE_CHILD = 'unassignment';


    public function logable()
    {
        return $this->morphTo();
    }
}
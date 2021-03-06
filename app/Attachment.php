<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    const DELETED_AT = 'update_time';
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'update_time';
    protected $table = "attachment";
    protected $fillable = array('filepath');
    protected $hidden = ['update_time','pivot','id','type','score','name','comment','status'];
}

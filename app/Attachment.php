<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = "attachment";
    const DELETED_AT = 'updated_at';
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'update_time';
    protected $fillable = array('filepath');
}

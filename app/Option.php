<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $hidden = ['created_at','updated_at','attachment','attachment_id'];
    
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }

    public function casa()
    {
        return $this->hasOne('App\Casa','id','casa_id');
    }
}

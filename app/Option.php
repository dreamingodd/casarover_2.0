<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }

    public function casa()
    {
        return $this->hasOne('App\Casa','id','casa_id');
    }
}

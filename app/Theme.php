<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }

    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }
}

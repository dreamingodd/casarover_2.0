<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $hidden = ['created_at','updated_at','attachment','attachment_id'];
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }

    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }
}

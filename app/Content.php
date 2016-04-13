<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "content";
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'update_time';
    protected $fillable = array('name','text','house');
    public function attachments() {
        return $this->belongsToMany('\App\Attachment', 'content_attachment');
    }

    public function themes()
    {
        return $this->belongsToMany('App\Theme');
    }
}

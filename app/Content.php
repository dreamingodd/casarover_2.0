<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "content";
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'update_time';
    protected $fillable = array('text');
    public function attachments() {
        return $this->belongsToMany('\App\Attachment', 'content_attachment');
    }
}

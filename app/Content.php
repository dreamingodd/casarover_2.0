<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "content";
    public function attachments() {
        return $this->belongsToMany('\App\Attachment', 'content_attachment');
    }
}

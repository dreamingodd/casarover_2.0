<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxCasa extends Model
{
    protected $table = "wx_casa";

    public function attachment() {
        return $this->belongsTo('App\Attachment');
    }
    public function contents() {
        return $this->belongsToMany('App\Content', 'wx_casa_content');
    }
    public function wxRooms() {
        return $this->hasMany('App\Entity\Wx\WxRoom');
    }
}

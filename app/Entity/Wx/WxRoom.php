<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxRoom extends Model
{
    protected $table = "wx_room";
    public function wxCasa() {
        return $this->belongsTo('App\Entity\Wx\WxCasa');
    }

    public function wxRoomDates() {
        return $this->hasMany('App\Entity\Wx\WxRoomDate','room_id','id');
    }
}

<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxRoomDate extends Model
{
    protected $table = "wx_room_date";
    public function wxRooms() {
        return $this->belongsTo('App\Entity\Wx\WxRoom','room_id', 'id');
    }
}

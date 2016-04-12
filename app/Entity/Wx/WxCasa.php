<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxCasa extends Model
{
    protected $table = "wx_casa";

    public function wxRooms() {
        return $this->hasMany('App\Entity\Wx\WxRoom');
    }
}

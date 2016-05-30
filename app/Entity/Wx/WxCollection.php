<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxCollection extends Model
{
    protected $table = "wx_collection";
    public function wxCasa() {
        return $this->hasOne('App\Entity\Wx\WxCasa','id','wx_casa_id');
    }
    public function wxUser() {
        return $this->hasOne('App\Entity\Wx\WxUser','id','wx_user_id');
    }
}

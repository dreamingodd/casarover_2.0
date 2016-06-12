<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class Wx18 extends Model
{
    protected $table = "wx_user_casa_18";
    public function wxCasa() {
        return $this->hasOne('App\Entity\Wx\WxCasa','id','wx_casa_id');
    }
    public function user() {
        return $this->hasOne('App\Entity\User','id','user_id');
    }
}

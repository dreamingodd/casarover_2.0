<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxCardCasa extends Model
{
    protected $table = "wx_vacation_card_casa";
    public function wxCasa() {
        return $this->hasOne('App\Entity\Wx\WxCasa','id','wx_casa_id');
    }
}

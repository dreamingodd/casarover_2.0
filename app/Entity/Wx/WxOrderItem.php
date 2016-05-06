<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxOrderItem extends Model
{
    protected $table = "wx_order_item";

    public function wxOrder() {
        return $this->belongsTo('App\Entity\Wx\WxOrder');
    }
    public function wxRoom() {
        return $this->belongsTo('App\Entity\Wx\WxRoom');
    }
}

<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxOrder extends Model
{
    const PAY_STATUS_NO = 0;
    const PAY_STATUS_YES = 1;
    const PAY_STATUS_REFUNDING = 2;
    const PAY_STATUS_REFUNDED = 3;
    const RESERVE_STATUS_NO = 0;
    const RESERVE_STATUS_YES = 1;
    const RESERVE_STATUS_FAIL = 2;
    const CONSUME_STATUS_NO = 0;
    const CONSUME_STATUS_YES = 1;
    const CONSUME_STATUS_EXPIRED = 2;

    protected $table = "wx_order";

    public function wxUser()
    {
        return $this->belongsTo('App\Entity\Wx\WxUser','wx_user_id','id');
    }
    public function wxCasa() {
        return $this->belongsTo('App\Entity\Wx\WxCasa');
    }
    public function wxOrderItems() {
        return $this->hasMany('App\Entity\Wx\WxOrderItem');
    }
}

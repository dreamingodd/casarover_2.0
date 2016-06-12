<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxOrder extends Model
{
    use SoftDeletes;
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
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Entity\User','user_id','id');
    }
    public function wxCasa()
    {
        return $this->belongsTo('App\Entity\Wx\WxCasa');
    }
    public function wxOrderItems()
    {
        return $this->hasMany('App\Entity\Wx\WxOrderItem');
    }
    public function wxScoreVariation()
    {
        return $this->hasOne('App\Entity\Wx\WxScoreVariation');
    }
}

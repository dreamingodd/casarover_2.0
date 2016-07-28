<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxBind extends Model
{
    const STATUS_APPLYING = 0;
    const STATUS_COMFIRMED = 1;
    const STATUS_DECLINED = 2;
    use SoftDeletes;

    protected $table = "wx_bind";

    public function user() {
        return $this->belongsTo('App\Entity\User');
    }

    public function wxCasa() {
        return $this->belongsTo('App\Entity\Wx\WxCasa');
    }

    public function dealer() {
        return $this->belongsTo('App\Entity\Dealer');
    }
    // 获取该管理者所能处理的所有订单
    public function orders()
    {
        // return $this->hasManyThrough('App\Entity\Order' , 'App\Entity\CasaOrder','order_id');
        return $this->hasMany('App\Entity\CasaOrder', 'wx_casa_id', 'wx_casa_id');
    }
}

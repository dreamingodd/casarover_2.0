<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Simply, 订单是用那个度假卡支付的。
 */
class VcOrderRelation extends Model
{
    public $timestamps = false;
    protected $table = "vc_order_relation";
}

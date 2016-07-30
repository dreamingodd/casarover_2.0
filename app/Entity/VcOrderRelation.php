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
    protected $hidden = ['vacationCard'];
    public function vacationCard()
    {
        return $this->hasOne('App\Entity\VacationCard','order_id','vacation_card_order_id');
    }
}

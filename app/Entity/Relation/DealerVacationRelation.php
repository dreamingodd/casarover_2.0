<?php

namespace App\Entity\Relation;

use Illuminate\Database\Eloquent\Model;

/**
 * Simply, 度假卡下单入口是由那家经销商提供的。
 */
class DealerVacationRelation extends Model
{
    public $timestamps = false;
    protected $table = "dealer_vacation_relation";
    public function vacationCard()
    {
        return $this->hasOne('App\Entity\VacationCard', 'order_id', 'vacation_card_order_id');
    }
    public function dealer()
    {
        return $this->hasOne('App\Entity\Dealer');
    }
}

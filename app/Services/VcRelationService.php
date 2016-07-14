<?php
namespace App\Services;

use Log;
use App\Entity\VcOrderRelation;

/** 民宿订单和度假卡订单的关系。 */
class VcRelationService {
    public function add($vacationOrderId, $casaOrderId) {
        Log::info(get_class() . " - relation add start.");
        $relation = new VcOrderRelation();
        $relation->vacation_card_order_id = $vacationOrderId;
        $relation->casa_order_id = $casaOrderId;
        $relation->save();
        Log::info(get_class() . " - relation add successfully.");
    }
}

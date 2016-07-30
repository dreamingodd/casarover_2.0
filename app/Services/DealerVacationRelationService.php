<?php
namespace App\Services;

use Log;
use App\Entity\Relation\DealerVacationRelation;

/** 民宿订单和度假卡订单的关系。 */
class DealerVacationRelationService {
    public function add($dealerId, $vacationOrderId) {
        Log::info(get_class() . " - relation add start.");
        $relation = new DealerVacationRelation();
        $relation->dealer_id = $dealerId;
        $relation->vacation_card_order_id = $vacationOrderId;
        $relation->save();
        Log::info(get_class() . " - relation add successfully.");
    }
}

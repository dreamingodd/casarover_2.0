<?php

namespace App\Entity;

use App\Entity\Order;

/**
 *
 */
class CasaOrder extends Order
{
    /** @var int */
    const RESERVE_STATUS_NO = 0;
    /** @var int */
    const RESERVE_STATUS_YES = 1;
    /** @var int 预约失败 */
    const RESERVE_STATUS_FAIL = 2;
    /** @var int 已消费/已完成 */
    const RESERVE_STATUS_CONSUMED = 3;
    /** @var int 已过期 */
    const RESERVE_STATUS_EXPIRED = 4;

    protected $table = "casa_order";
    public $timestamps = false;

    /**
     * Order contains basic information of an order.
     */
    public function order()
    {
        return $this->belongsTo('App\Entity\Order');
    }
}

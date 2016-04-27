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
    const RESERVE_STATUS_PROCESS = 2;
    const RESERVE_STATUS_FAIL = 3;
    const CONSUME_STATUS_NO = 0;
    const CONSUME_STATUS_YES = 1;
    const CONSUME_STATUS_EXPIRED = 2;

    protected $table = "wx_order";
}

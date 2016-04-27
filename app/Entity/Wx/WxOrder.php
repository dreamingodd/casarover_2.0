<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxOrder extends Model
{
    const STATUS_PAYING = 0;
    const STATUS_PAYED = 1;
    const STATUS_RESERVED = 2;
    const STATUS_CONSUMED = 3;
    const STATUS_REFUNDING = 4;
    const STATUS_REFUNDED = 5;
    const STATUS_CANCELED = 6;

    protected $table = "wx_order";
}

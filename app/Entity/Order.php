<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Basic order information for any exchange/payment/transaction.
 */
class Order extends Model
{
    /** @var int */
    const TYPE_UNKNOWN = 0;
    /** @var int 民宿 */
    const TYPE_CASA = 1;
    /** @var int 民宿 */
    const TYPE_VACATION_CARD = 2;

    /** @var int */
    const PAY_TYPE_UNKNOWN = 0;
    /** @var int 微信支付 */
    const PAY_TYPE_WX = 1;
    /** @var int 支付宝 */
    const PAY_TYPE_ALI = 2;

    /** @var int 未支付 */
    const PAY_STATUS_NO = 0;
    /** @var int 已支付 */
    const PAY_STATUS_YES = 1;
    /** @var int 申请退款 */
    const PAY_STATUS_REFUNDING = 2;
    /** @var int 已退款 */
    const PAY_STATUS_REFUNDED = 3;

    protected $table = "order";
    protected $fillable = array(
        'id', 'user_id', 'order_id', 'type', 'pay_type', 'name', 'pay_id',
        'total', 'status', 'deleted_at', 'created_at', 'updated_at'
    );
}

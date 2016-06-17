<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Basic order information for any exchange/payment/transaction.
 */
class Order extends Model
{
    use SoftDeletes;

    /** @var int */
    const TYPE_UNKNOWN = 0;
    /** @var int 1 - 民宿 */
    const TYPE_CASA = 1;
    /** @var int 2 - 度假卡 */
    const TYPE_VACATION_CARD = 2;
    /** @var int 3 - 使用度假卡预定民宿 */
    const TYPE_OPPORTUNITY = 3;

    /** @var int */
    const PAY_TYPE_UNKNOWN = 0;
    /** @var int 微信支付 */
    const PAY_TYPE_WX = 1;
    /** @var int 支付宝 */
    const PAY_TYPE_ALI = 2;

    /** @var int 未支付 */
    const STATUS_UNPAYED = 0;
    /** @var int 已支付 */
    const STATUS_PAYED = 1;
    /** @var int 申请退款 */
    const STATUS_REFUNDING = 2;
    /** @var int 已退款 */
    const STATUS_REFUNDED = 3;
    /** @var int 已完成 */
    const STATUS_COMPLETED = 4;

    protected $table = "order";
    protected $fillable = array(
        'id', 'user_id', 'order_id', 'type', 'pay_type', 'name', 'pay_id',
        'total', 'status', 'deleted_at', 'created_at', 'updated_at'
    );

    /**
     * The user who make this order.
     */
    public function user()
    {
        return $this->belongsTo('App\Entity\User');
    }

    /**
     * The items of the order.
     */
    public function orderItems()
    {
        return $this->hasMany('App\Entity\OrderItem');
    }

    /** */
    public function casaOrder() {
        if ($this->type == self::TYPE_CASA) {
            return $this->hasOne('App\Entity\CasaOrder');
        }
        return null;
    }

    public function Opportunity() {
        return $this->hasOne('App\Entity\Opportunity', 'order_item_id','id');
    }
}

<?php

namespace App\Entity;

use Config;
use Exception;
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

    /** @var int */
    const PAY_TYPE_UNKNOWN = 0;
    /** @var int 微信支付 */
    const PAY_TYPE_WX = 1;
    /** @var int 支付宝 */
    const PAY_TYPE_ALI = 2;
    /** @var int 度假卡 */
    const PAY_TYPE_CARD = 3;

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

    /** @var string ORDER_PREFIX 民宿订单 - */
    const CASA_ORDER_PREFIX = "民宿订单 - ";

    protected $table = "order";
    protected $fillable = array(
        'id', 'user_id', 'order_id', 'type', 'pay_type', 'name', 'pay_id',
        'total', 'status', 'deleted_at', 'created_at', 'updated_at','photo_path'
    );
    protected $hidden = ['created_at','updated_at','deleted_at','user','pivot','pay_type','pay_id','user_id','orderItems'];

    /** Generate an orderId for payment Identity. */
    public function generateOrderId() {
        if ($this->id) {
            $this->order_id = Config::get('casarover.wx_shopid') . '-' . $this->id;
        } else {
            throw Exception('Save first! Otherwise there\'s no id');
        }

    }

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

    /**
     * 子类：民宿订单
     */
    public function casaOrder() {
        if ($this->type == self::TYPE_CASA) {
            return $this->hasOne('App\Entity\CasaOrder');
        }
        // will throw exception: meaning you must not use this relation while TYPE is not TYPE_CASA.
        return null;
    }

    /**
     * 子类：度假卡订单
     */
    public function vacationCardOrder() {
        if ($this->type == self::TYPE_VACATION_CARD) {
            return $this->hasOne('App\Entity\VacationCardOrder');
        }
        // will throw exception: meaning you must not use this relation while TYPE is not TYPE_VACATION_CARD.
        return null;
    }

    public function Opportunity() {
        return $this->hasOne('App\Entity\Opportunity', 'order_item_id','id');
    }
    // 订单下度假卡的信息
    public function vacationCard()
    {
        return $this->hasOne('App\Entity\VacationCard','order_id','id');
    }
    /**
    * 属于哪个民宿的订单,依赖于下单的时候进行casa_order的绑定
    */
    public function wxCasa()
    {
        return $this->belongsToMany('App\Entity\Wx\wxCasa','casa_order');
    }
}

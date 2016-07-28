<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    const STATUS_NEW = 0;
    const STATUS_USED = 1;
    const STATUS_TEST= 2;
    protected $table = 'coupon';
    protected $fillable = ['dealer_id', 'client_order_id', 'code', 'key', 'price', 'left', 'type', 'status'];
}

<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $fillable = ['dealer_id', 'client_order_id', 'code', 'key', 'price', 'left'];
}

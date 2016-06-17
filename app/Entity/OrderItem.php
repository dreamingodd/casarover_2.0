<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * OrderItem
 */
class OrderItem extends Model
{
    protected $table = "order_item";
    public $timestamps = false;
    protected $fillable = ["order_id","product_id","name","photo_path","price","quantity"];

    /**
     * Belongs to an order.
     */
    public function order() {
        return $this->belongsTo('App\Entity\Order');
    }

    /**
     * Link to a product.
     */
    public function product() {
        return $this->belongsTo('App\Entity\Product');
    }

    public function opportunity()
    {
        return $this->hasOne('App\Entity\Opportunity');
    }
}

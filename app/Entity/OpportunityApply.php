<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class OpportunityApply extends Model
{
    /**
     * @var string
     * status 0 申请中
     *        1 申请通过
     *        2 申请被拒绝
     */
    protected $table = 'opportunity_apply';
    protected $fillable = ['user_id','owner_id','order_item_id','quantity','status'];

    public function item()
    {
        return $this->hasOne('App\Entity\OrderItem','id','order_item_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Entity\Order','id','order_item_id');
    }
}

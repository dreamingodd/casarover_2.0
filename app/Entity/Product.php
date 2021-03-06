<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Product extends Model
{
    /** @var int */
    const TYPE_UNKNOWN = 0;
    /** @var int */
    const TYPE_CASA_ROOM = 1;
    /** @var int */
    const TYPE_VACATION_CARD = 2;

    protected $table = "product";
    protected $fillable = ['parent_id','attachment_id','type','name'];
    protected $hidden = ['attachment_id','type','deleted_at','created_at','updated_at','stock','img','wxCasa'];


    /**
     * TYPE_CASA_ROOM will belongs to a wx casa.
     */
    public function wxCasa() {
        if ($this->type == self::TYPE_CASA_ROOM || $this->type == self::TYPE_VACATION_CARD) {
            return $this->hasOne('App\Entity\Wx\WxCasa','id','parent_id');
        }
        return null;
    }

    public function casaMessage()
    {
        return $this->hasOne('App\Entity\Wx\WxCasa','id','parent_id');
    }

    public function stock() {
        return $this->hasOne('App\Entity\Stock','product_id','id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Entity\OrderItem','product_id','id');
    }

    // public function img()
    // {
    //     return $this->belongsTo('App\Attachment','attachment_id','id');
    // }
}

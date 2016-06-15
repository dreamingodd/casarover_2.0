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

    /**
     * TYPE_CASA_ROOM will belongs to a wx casa.
     */
    public function wxCasa() {
        if (TYPE_CASA_ROOM == 1) {
            return $this->belongsTo('App\Entity\Wx\WxCasa');
        }
        return null;
    }

    public function stock() {
        return $this->hasOne('App\Entity\Stock');
    }

}

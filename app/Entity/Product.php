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

    protected $table = "product";

    /**
     * TYPE_CASA_ROOM will belongs to a wx casa.
     */
    public function wxCasa() {
        if (TYPE_CASA_ROOM == 1) {
            return $this->belongsTo('App\Entity\Wx\WxCasa');
        }
        return null;
    }
}

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
}

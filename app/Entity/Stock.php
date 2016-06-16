<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = ['surplus','product_id','orig'];
}

<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    public $timestamps = false;
    protected $table = 'opportunity';
    protected $fillable = ['left_quantity','order_item_id'];
}

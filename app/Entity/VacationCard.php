<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class VacationCard extends Model
{
    public $timestamps = false;
    protected $table = 'vacation_card_order';
    protected $fillable = ['order_id','card_no','style','expire_date','start_date'];
}

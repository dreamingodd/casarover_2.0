<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    const KEY_LENGTH = 18;

    protected $table = 'dealer';
    protected $fillable = ['name', 'code', 'key', 'dev_key', 'deal_mode', 'coupon_mode'];

    //对应的度假卡
    public function vacationCard()
    {
        return $this->belongsTo('App\Entity\VacationCard');
    }
}

<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxScoreVariation extends Model
{
    const TYPE_ORDER = 1;
    const TYPE_ACTIVITY = 2;
    protected $table = "wx_score_variation";
    protected $fillable = [
        'wx_membership_id' , 'wx_score_activity_id','name','type','score'
    ];
}

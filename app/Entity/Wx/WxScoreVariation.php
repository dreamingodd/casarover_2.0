<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxScoreVariation extends Model
{
    const TYPE_ORDER = 1;
    const TYPE_ACTIVITY = 2;
    const SCORE_PERCENT = 0.1;
    protected $table = "wx_score_variation";

}

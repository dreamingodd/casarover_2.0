<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxScoreActivity extends Model
{
    use SoftDeletes;

    protected $table = "wx_score_activity";
}

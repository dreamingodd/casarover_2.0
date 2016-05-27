<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxVote extends Model
{
    protected $table = "wx_vote";
    protected $fillable = ['18_id','wx_user_id'];
}

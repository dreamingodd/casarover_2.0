<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxMembership extends Model
{
    protected $table = "wx_membership";
    protected $fillable = [
        'wx_user_id' , 'level','score','accumulated_score'
    ];
    public function wxUser()
    {
        return $this->belongsTo('App\Entity\Wx\WxUser');
    }

    public function Wxscore()
    {
        return $this->hasMany('App\Entity\Wx\WxScoreVariation');
    }
}

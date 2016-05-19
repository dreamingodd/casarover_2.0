<?php

namespace App\Entity\Wx;

use Config;
use Illuminate\Database\Eloquent\Model;

class WxMembership extends Model
{
    protected $table = "wx_membership";

    public function wxUser()
    {
        return $this->belongsTo('App\Entity\Wx\WxUser');
    }

    public static function getLevelDetail($level)
    {
        return Config::get('casarover.wx_membership_detail')[$level];
    }
}

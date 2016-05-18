<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxMembership extends Model
{
    protected $table = "wx_membership";

    public function wxUser()
    {
        return $this->belongsTo('App\Entity\Wx\WxUser');
    }
}

<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxBind extends Model
{
    const STATUS_APPLYING = 0;
    const STATUS_COMFIRMED = 1;
    const STATUS_DECLINED = 2;
    use SoftDeletes;

    protected $table = "wx_bind";

    public function user() {
        return $this->belongsTo('App\Entity\Wx\WxUser');
    }

    public function casa() {
        return $this->belongsTo('App\Entity\Wx\WxCasa');
    }
}

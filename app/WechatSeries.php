<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatSeries extends Model
{
    protected $table = "wechat_series";
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }
}

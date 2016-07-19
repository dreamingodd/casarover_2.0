<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatSeries extends Model
{
    protected $table = "wechat_series";
    protected $hidden = ['created_at','updated_at','thumb_id','thumbnail','attachment_id'];
    public function attachment()
    {
        return $this->hasOne('App\Attachment','id','attachment_id');
    }

    public function thumbnail()
    {
        return $this->hasOne('App\Attachment','id','thumb_id');
    }
}

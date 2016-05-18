<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WxCasa extends Model
{
    use SoftDeletes;

    protected $table = "wx_casa";
    protected $dates = ["deleted_at"];

    public function attachment() {
        return $this->belongsTo('App\Attachment');
    }
    public function casa() {
        return $this->belongsTo('App\Casa');
    }
    public function contents() {
        return $this->belongsToMany('App\Content', 'wx_casa_content');
    }
    public function wxRooms() {
        return $this->hasMany('App\Entity\Wx\WxRoom');
    }

    // 民宿主人
    public function wxUsers() {
        return $this->belongsToMany('App\Entity\Wx\WxUser', 'wx_bind');
    }
    public function wxBinds() {
        return $this->hasMany('App\Entity\Wx\WxBind');
    }

    // Now seems useless.
    public function getName() {
        if (empty($this->name)) {
            return $this->casa->name;
        } else {
            return $this->name;
        }
    }

    /**
     *  Get thumbnail from WxCasa or Casa
     */
    public function thumbnail() {
        if (empty($this->attachment->filepath)) {
            return $this->casa->attachment->filepath;
        } else {
            return $this->attachment->filepath;
        }
    }
}

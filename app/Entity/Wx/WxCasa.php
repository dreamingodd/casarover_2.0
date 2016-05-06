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
        return $this->belongsToMany('App\Content', 'wx_casa_content')->orderBy('id');
    }
    public function wxRooms() {
        return $this->hasMany('App\Entity\Wx\WxRoom');
    }
    public function getName() {
        if (empty($this->name)) {
            return $this->casa->name;
        } else {
            return $this->name;
        }
    }
}

<?php

namespace App\Entity\Wx;

use App\Entity\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**  */
class WxCasa extends Model
{
    use SoftDeletes;

    protected $table = "wx_casa";
    protected $dates = ["deleted_at"];
    protected $hidden = ['deleted_at','created_at','updated_at','deleted_at'];

    public function attachment() {
        return $this->belongsTo('App\Attachment');
    }
    public function casa() {
        return $this->belongsTo('App\Casa');
    }
    public function contents() {
        return $this->belongsToMany('App\Content', 'wx_casa_content');
    }
    public function products() {
        return  $this->hasMany('App\Entity\Product', 'parent_id', 'id');
    }
    public function rooms() {
        $products = $this->products;
        $rooms = array();
        foreach($products as $p) {
            if ($p->type == Product::TYPE_CASA_ROOM) {
                array_push($rooms, $p);
            }
        }
        return $rooms;
    }

    // 民宿主人
    public function users() {
        return $this->belongsToMany('App\Entity\User', 'wx_bind');
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
        if (empty($this->casa->id)) {
            return $this->attachment->filepath;
        } else {
            return $this->casa->attachment->filepath;
        }
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatArticle extends Model
{
    protected $table = "wechat_article";
    const DELETED_AT = 'update_at';
    const UPDATED_AT = 'update_at';
    const CREATED_AT = 'update_at';
    /**探庐系列*/
    const TYPE_EXPLORE = 1;
    /**民宿风采*/
    const TYPE_STYLE = 2;
    /**主题民宿*/
    const TYPE_THEME = 3;
    protected $hidden = ['update_at'];

    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
    public function wechatSeries()
    {
        return $this->belongsTo('App\WechatSeries', 'series');
    }
}

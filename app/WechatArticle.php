<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatArticle extends Model
{
    protected $table = "wechat_article";
    const DELETED_AT='update_at';
	const UPDATED_AT='update_at';
	const CREATED_AT = 'update_at';
}

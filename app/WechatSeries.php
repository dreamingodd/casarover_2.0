<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatSeries extends Model
{
    protected $table = "wechat_series";
    const DELETED_AT='update_at';
	const UPDATED_AT='update_at';
	const CREATED_AT = 'update_at';
}

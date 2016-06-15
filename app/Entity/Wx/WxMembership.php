<?php

namespace App\Entity\Wx;

use Config;
use Illuminate\Database\Eloquent\Model;

class WxMembership extends Model
{
    protected $table = "wx_membership";
    protected $fillable = [
        'user_id' , 'level','score','accumulated_score'
    ];
    public function user()
    {
        return $this->belongsTo('App\Entity\User');
    }
    public static function getLevelDetail($level)
    {
        return Config::get('config.wx_membership_detail')[$level];
    }
}

<?php

namespace App\Entity\Wx;

use Illuminate\Database\Eloquent\Model;

class WxUser extends Model
{
    const TEST_USER_NO = 0;
    const TEST_USER_YES = 1;
    const MALE = 1;
    const FEMALE = 2;
    protected $table = "wx_user";

    /**
     * For now, one user could be binded merely to one wx casa.
     * @2016-05-09
     */
    public function wxBind()
    {
        return $this->hasMany('App\Entity\Wx\WxBind')->first();
    }

    public function casas()
    {
        return $this->belongsToMany('App\Entity\Wx\WxCasa', 'wx_bind');
    }

    public function wxBinds()
    {
        return $this->hasMany('App\Entity\Wx\WxBind');
    }
    public function wxMembership() {
        return $this->hasOne('App\Entity\Wx\WxMembership');
    }

    public function wxScoreVariation()
    {
        return $this->hasManyThrough('App\Entity\Wx\WxScoreVariation', 'App\Entity\Wx\WxMembership');
    }
}

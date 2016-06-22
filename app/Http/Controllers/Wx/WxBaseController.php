<?php

namespace App\Http\Controllers\Wx;

use Cache;
use Config;
use DB;
use Log;
use App\Common\WxTools;
use App\Entity\Wx\WxCasa;
use App\Http\Controllers\Controller;

/**
 *
 */
class WxBaseController extends Controller
{
    use WxTools;

    /**
     * 从微信获得操作公众号的access_token
     * 保存时间由getBaseAccessTokenFromCache方法确定
     */
    protected function getBaseAccessTokenFromWx()
    {
        $appid = Config::get('casarover.wx_appid');
        $secret = Config::get('casarover.wx_appsecret');
        $json = WxTools::getBaseAccessToken($appid, $secret);
        return $json['access_token'];
    }

    /**
     * 从cache中获得保存操作公众号的access_token
     */
    protected function getBaseAccessTokenFromCache()
    {
        $token = Cache::get('access_token');
        if (!$token) {
            if (env('ENV') == 'DEV') {
                $token = rand(1000, 10000);
            } else {
                $token = $this->getBaseAccessTokenFromWx();
            }
            Log::info('Wx Token Refreshed - ' . $token);
            // Save the access_token in cache,
            // will be destroyed in 20 minutes.
            Cache::put('access_token', $token, 20);
        }
        return $token;
    }

    /**
     * 是否关注公众号
     * @param string $openid 微信openid
     */
    protected function getSubscribe($openid)
    {
        $token = $this->getBaseAccessTokenFromCache();
        if (env('ENV') == 'DEV') return 1;
        else return WxTools::getSubscribeInfo($token, $openid)['subscribe'];
    }

    /**
     * @param WxCasa $casa
     */
    protected function convertToViewCasa(WxCasa $casa)
    {
        $casa->cheapestPrice = DB::table('wx_room')->where('wx_casa_id', $casa->id)->min('price');
        // Extract room from products.
        $casa->rooms = $casa->rooms();
        if (empty($casa->casa_id)) {
            if (!empty($casa->attachment->filepath)) {
                $casa->thumbnail = $casa->attachment->filepath;
            }
        } else {
            if (!empty($casa->casa->attachment->filepath)) {
                $casa->thumbnail = $casa->casa->attachment->filepath;
            }
        }
    }

}

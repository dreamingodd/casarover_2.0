<?php

namespace App\Http\Controllers\Wx;

use Cache;
use Config;
use Log;
use App\Common\WxTools;
use App\Http\Controllers\Controller;

class WxBaseController extends Controller
{
    use WxTools;

    protected function getBaseAccessTokenFromWx() {
        $appid = Config::get('casarover.appid');
        $secret = Config::get('casarover.appsecret');
        $json = WxTools::getBaseAccessToken($appid, $secret);
        return $json['access_token'];
    }

    protected function getBaseAccessTokenFromCache() {
        $token = Cache::get('access_token');
        if (!$token) {
            if (env('ENV') == 'DEV') {
                $token = rand(1000, 10000);
            } else {
                $token = $this->getBaseAccessTokenFromWx();
            }
            Log::info('Wx Token Refreshed - ' . $token);
            Cache::put('access_token', $token, 1);
        }
        return $token;
    }

    protected function getSubscribe($openid) {
        $token = $this->getBaseAccessTokenFromCache();
        dd($token);
        if (env('ENV') == 'DEV') return 1;
        else return WxTools::getSubscribeInfo($token, $openid)['subscribe'];
    }
}

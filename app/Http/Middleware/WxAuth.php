<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

class WxAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $appid = Config::get("casarover.wx_appid");
        $appsecret = Config::get("casarover.wx_appsecret");
        if (Session::has('wxUser')) {
            return $next($request);
        } else {
            if (env('ENV') == 'PROD') {
                if (isset($_GET['code'])) {
                    return redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid
                            . "&redirect_uri=http%3A%2F%2Fwww.casarover.com%2Fwx&response_type=code"
                            . "&scope=snsapi_userinfo&state=STATE#wechat_redirect");
                } else {
                    $wxCode = $_GET['code'];
                    $json = $this->getAccessToken($appid, $appsecret, $wxCode);
                    $accessToken = $json_obj['access_token'];
                    $openid = $json_obj['openid'];
                    echo $openid;
                }
                // return $next($request);
            } else if (env('ENV') == 'DEV') {
                return redirect("https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxeafd79d8fcbd74ee"
                . "&redirect_uri=http%3A%2F%2Fwww.casarover.com%2Fwx&response_type=code"
                . "&scope=snsapi_userinfo&state=STATE#wechat_redirect");
                echo 'DEV';
            }
        }
    }

    private function getAccessToken($appid, $appsecret, $wxCode) {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='
                . $appid . '&secret=' . $appsecret .'&code=' . $wxCode . '&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $jsonObj = json_decode($res, true);
        return $jsonObj;
    }

    private function getUserInfo($accessToken, $openid) {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token="
                . $accessToken . "&openid=" . $openid . "&lang=zh_CN ";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $jsonObj = json_decode($res, true);
        return $jsonObj;
    }
}

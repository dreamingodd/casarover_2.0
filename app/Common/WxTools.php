<?php

namespace App\Common;

use Session;
use App\Entity\Wx\WxUser;

trait WxTools
{

        public static function getBaseScopeUrl($appid, $subPath = '')
        {
            return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid
                    . "&redirect_uri=http%3A%2F%2Fwww.casarover.com" + $subPath + "&response_type=code"
                    . "&scope=snsapi_base&state=STATE#wechat_redirect";
        }

        public static function getUserInfoScopeUrl($appid, $subPath = '')
        {
            return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid
                    . "&redirect_uri=http%3A%2F%2Fwww.casarover.com" + $subPath + "&response_type=code"
                    . "&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        }

        public static function getOpenidAndAccessToken($appid, $appsecret, $wxCode)
        {
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

        public static function getUserInfo($accessToken, $openid)
        {
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

        public static function getUser()
        {
            $openid = Session::get('openid');
            if (empty($openid)) {
                return null;
            } else {
                $user = WxUser::where('openid', $openid)->distinct()->get();
                return $user;
            }
        }
}

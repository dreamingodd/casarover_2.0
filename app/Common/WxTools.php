<?php

namespace App\Common;

use Session;
use App\Entity\User;

trait WxTools
{

        public static function getBaseScopeUrl($appid, $url = '')
        {
            if (empty($url)) {
                $url = "http%3A%2F%2Fwww.casarover.com%2Fwx";
            }
            $url = str_replace("/", "%2F", $url);
            return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid
                    . "&redirect_uri=" . $url . "&response_type=code"
                    . "&scope=snsapi_base&state=STATE#wechat_redirect";
        }

        public static function getUserInfoScopeUrl($appid, $url = '')
        {
            if (empty($url)) {
                $url = "http%3A%2F%2Fwww.casarover.com%2Fwx";
            }
            $url = str_replace("/", "%2F", $url);
            return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid
                    . "&redirect_uri=" . $url . "&response_type=code"
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

        public static function getBaseAccessToken($appid, $appsecret) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid="
                    . "$appid&secret=$appsecret";
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

        public static function getSubscribeInfo($baseToken, $openid) {
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$baseToken&openid=$openid";
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
            $userId = Session::get('user_id');
            if (empty($userId)) {
                return null;
            } else {
                $user = User::find($userId);
                return $user;
            }
        }
}

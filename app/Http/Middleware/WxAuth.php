<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App\Entity\Wx\WxUser;
use App\Common\WxTools;

class WxAuth
{

    use WxTools;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('openid')) {
            return $next($request);
        } else {
            if (env('ENV') == 'PROD') {
                $appid = Config::get("casarover.wx_appid");
                $appsecret = Config::get("casarover.wx_appsecret");
                if (!isset($request->all()['code'])) {
                    return redirect(WxTools::getUserInfoScopeUrl($appid));
                } else {
                    $wxCode = $request->all()['code'];
                    $baseJson = WxTools::getOpenidAndAccessToken($appid, $appsecret, $wxCode);
                    if (empty($baseJson['access_token'])) {
                        return "登录失败！";
                    }
                    $accessToken = $baseJson['access_token'];
                    $openid = $baseJson['openid'];
                    $user = WxUser::where('openid', $openid)->get()->first();
                    if (empty($user)) {
                        // The very first login.
                        $userInfoJson = WxTools::getUserInfo($accessToken, $openid);
                        $user = $this->saveWxUser($userInfoJson);
                    }
                    Session::put('openid', $openid);
                    Session::put('wx_user_id', $user->id);
                    Session::save();
                    return $next($request);
                }
            } else if (env('ENV') == 'DEV') {
                $user = $this->getDummyUser();
                Session::put('openid', $user->openid);
                Session::put('wx_user_id', $user->id);
                Session::save();
                return $next($request);
            }
        }
    }

    private function saveWxUser($jsonUser)
    {
        $user = new WxUser();
        $user->openid = $jsonUser['openid'];
        $user->nickname = $jsonUser['nickname'];
        $user->sex = $jsonUser['sex'];
        $user->headimgurl = $jsonUser['headimgurl'];
        $user->save();
        return $user;
    }

    /**
     * @return $user a dummy user for dev machine to run testings.
     */
    private function getDummyUser()
    {
        $userId = 9999;
        $user = WxUser::find($userId);
        if (empty($user)) {
            $user = new WxUser();
            $user->id = $userId;
            $user->nickname = "Kobe";
            $user->openid = "FAKE-openid-kbMrB-T0ZGEjGZBIX21";
            $user->cellphone = "18368841168";
            $user->sex = 1;
            $user->headimgurl =
                    "http://casarover.oss-cn-hangzhou.aliyuncs.com/image/image_20160427-162517-907r1707.jpg";
            $user->save();
        }
        return $user;
    }
}

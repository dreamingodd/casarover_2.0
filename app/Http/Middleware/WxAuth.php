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
        $appid = Config::get("casarover.wx_appid");
        $appsecret = Config::get("casarover.wx_appsecret");
        if (Session::has('openid')) {
            return $next($request);
        } else {
            if (env('ENV') == 'PROD') {
                if (!isset($request->all()['code'])) {
                    return redirect(WxTools::getUserInfoScopeUrl($appid));
                } else {
                    $wxCode = $request->all()['code'];
                    $baseJson = WxTools::getOpenidAndAccessToken($appid, $appsecret, $wxCode);
                    $accessToken = $baseJson['access_token'];
                    $openid = $baseJson['openid'];
                    $user = WxUser::where('openid', $openid)->distinct()->get();
                    if (empty($user)) {
                        // The very first login.
                        $userInfoJson = WxTools::getUserInfo($accessToken, $openid);
                        $this->saveWxUser($userInfoJson);
                    }
                    Session::put('openid', $openid);
                    return $next($request);
                }
            } else if (env('ENV') == 'DEV') {
                $user = $this->getDummyUser();
                Session::put('openid', $user->openid);
                return $next($request);
            }
        }
    }

    private function saveWxUser($userJson)
    {
        $user = new WxUser();
        $user->openid = $userJson->openid;
        $user->nickname = $userJson->nickname;
        $user->sex = $userJson->sex;
        $user->headimgurl = $userJson->headimgurl;
        $user->save();
    }

    /**
     * @return a dummy user for dev machine to run testings.
     */
    private function getDummyUser()
    {
        $user = WxUser::find(9999);
        if (empty($user)) {
            $user = new WxUser();
            $user->id = 9999;
            $user->nickname = "Lunatic";
            $user->openid = "FAKE-openid-kbMrB-T0ZGEjGZBIX24";
            $user->unionid = "FAKE-unionid-ssddiibbllssnnllss";
            $user->cellphone = "18368841168";
            $user->sex = 1;
            $user->headimgurl =
                    "http://casarover.oss-cn-hangzhou.aliyuncs.com/image/image_20160427-162517-907r1707.jpg";
            $user->save();
        }
        return $user;
    }
}

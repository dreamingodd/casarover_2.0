<?php

namespace App\Http\Middleware;

use App\Common\WxTools;
use App\Entity\User;
use Closure;
use Config;
use Log;
use Session;

/**
 * This middleware is used for wx user's automatic login.
 */
class WxAuth
{

    use WxTools;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('user_id')) {
            return $next($request);
        } else {
            if (env('ENV') == 'PROD') {
                $appid = Config::get("casarover.wx_appid");
                $appsecret = Config::get("casarover.wx_appsecret");
                $url = $request->url();
                $k = $request->fullUrl();
                Log::info('furl'.$url);
                Log::info('kurl'.$k);
                if (!isset($request->all()['code'])) {
                    return redirect(WxTools::getUserInfoScopeUrl($appid, $url));
                } else {
                    $wxCode = $request->all()['code'];
                    $baseJson = WxTools::getOpenidAndAccessToken($appid, $appsecret, $wxCode);
                    // TODO refactor
                    // Maybe others share their link with their code.
                    // Then would return "invalid code" error.
                    // This approach here seems to go into a endless loop of getting wrong code and set curl request
                    // again when other errors occur in the phase of getting openid,
                    // however I don't poccess a better solution for now.
                    if (empty($baseJson['access_token'])) {
                        return redirect('http://www.casarover.com/wx');
                    }
                    $accessToken = $baseJson['access_token'];
                    $openid = $baseJson['openid'];
                    $user = User::where('openid', $openid)->get()->first();
                    $userInfoJson = WxTools::getUserInfo($accessToken, $openid);
                    Log::info(get_class() . ' - ' . "User login by wechat: " . $userInfoJson['nickname']
                            .' -- ' . $userInfoJson['openid']);
                    $user = $this->saveUser($userInfoJson, $user);
                    Session::put('user_id', $user->id);
                    Session::save();
                    return $next($request);
                }
            } else if (env('ENV') == 'DEV') {
                $user = $this->getDummyUser();
                Session::put('user_id', $user->id);
                Session::save();
                return $next($request);
            }
        }
    }

    /**
     * Persist user in DB.casarover.user
     *
     * @param mixed $jsonUser
     * @param mixed $user
     */
    private function saveUser($jsonUser, $user = null)
    {
        if (empty($user)) {
            // The very first login.
            $user = new User();
        }
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
        $userId = Config::get('config.dummy_user_id');
        $user = User::find($userId);
        if (empty($user)) {
            $user = new User();
            $user->id = $userId;
            $user->nickname = "Kobe";
            $user->openid = "FAKE-openid-kbMrB-T0ZGEjGZBIX88";
            $user->cellphone = "18368841168";
            $user->sex = 1;
            $user->headimgurl =
                    "http://casarover.oss-cn-hangzhou.aliyuncs.com/image/image_20160427-162517-907r1707.jpg";
            $user->save();
        }
        return $user;
    }
}

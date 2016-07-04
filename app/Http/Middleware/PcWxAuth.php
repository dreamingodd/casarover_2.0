<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Log;
use Session;

/**
 * This middleware is used for wx user's automatic login.
 */
class WxAuth
{


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
                    Log::info("User login by wechat: " . $userInfoJson['nickname'] .' -- ' . $userInfoJson['openid']);
                    $user = $this->saveUser($userInfoJson, $user);
                    Session::put('user_id', $user->id);
                    Session::save();
                    return $next($request);
                }
            } else if (env('ENV') == 'DEV') {
                $user = $this->getDummyUser();
                Session::put('openid', $user->openid);
                Session::put('user_id', $user->id);
                Session::save();
                return $next($request);
            }
        }
    }

}

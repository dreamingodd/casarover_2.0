<?php

namespace App\Http\Controllers\Wx;


use App\Entity\Wx\WxScoreActivity;
use App\Entity\Wx\WxScoreVariation;
use DB;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Session;
use App\Entity\Wx\WxUser;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxMembership;
use Log;

class WxSiteController extends Controller
{
    /**
     * Collect normal casas and test casas.
     * Will show test casas if the user is a test user.
     */
    public function index()
    {
        $wxCasas = WxCasa::where('test', 0)->orderBy('id', 'desc')->get();
        foreach ($wxCasas as $casa) {
            $this->convertToViewCasa($casa);
        }
        $user = WxUser::find(Session::get('wx_user_id'));
        $testWxCasas = array();
        if ($user->test) {
            $testWxCasas = WxCasa::where('test', 1)->orderBy('id', 'desc')->get();
            foreach ($testWxCasas as $casa) {
                $this->convertToViewCasa($casa);
            }
        }
        return view('wx.wxIndex', compact('wxCasas', 'testWxCasas'));
    }

    public function casa($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('wx.wxCasaDetail', compact('wxCasa'));
    }

    public function user($tips=null)
    {
        $wxUser = WxUser::find(Session::get('wx_user_id'));
        $orders = WxOrder::where('wx_user_id', Session::get('wx_user_id'))->orderBy('id', 'desc')->get();
        $percent = 0;
        if (!empty($wxUser->wxMembership->id)) {
            $accumulatedScore = $wxUser->wxMembership->accumulated_score;
            $percent = $accumulatedScore
                    / WxMembership::getLevelDetail($wxUser->wxMembership->level + 1)['score']
                    * 100;
            $levelStr = WxMembership::getLevelDetail($wxUser->wxMembership->level)['name'];
        }
        return view('wx.wxUser', compact('orders', 'wxUser','percent', 'levelStr','tips'));
    }

    public function order($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxUser = WxUser::find(Session::get('wx_user_id'));
        return view('wx.wxOrder', compact('wxCasa', 'wxUser'));
    }

    //积分详情页面
    public function scoreVariation()
    {
        $userid = Session::get('wx_user_id');
        return view('wx.scoreVariation',compact('userid'));
    }

    //积分详情的json数据
    public function scoreVariationJson($wx_user_id)
    {
        $user = WxUser::find($wx_user_id);
        $scores = $user->wxScoreVariation()->simplePaginate(15);
        foreach($scores as $score)
        {
            $score->money = $score->score;
            $score->time = $score->created_at->format('Y-m-d H:i');
        }
        return response()->json($scores);
    }

    /**
     * 注册成为会员
     * */
    public function registerMember(Request $request)
    {
        $wxMember = WxUser::find(Session::get('wx_user_id'))->wxMembership;
        if($wxMember)
        {
            return redirect('/wx/user');
        };
        $user =WxMembership::create([
            'wx_user_id' => Session::get('wx_user_id'),
            'level' => 0,
            'score' => 0,
            'accumulated_score' => 0
        ]);
        $this->createWxScoreVariation($user->id,0,'注册',WxScoreVariation::TYPE_ACTIVITY,200);
        $this->changeWxMembershipScore(200);
        $tips = '欢迎加入探庐者<br>送你200积分祝你玩得愉快';
        return $this->user($tips);
    }
    /**
     * 扫名片获得积分
     * 如果是第二次扫的提示已经扫过了
     * */
    public function creditScore(Request $request)
    {

        $wxMember = WxUser::find(Session::get('wx_user_id'))->wxMembership;
        if(!$wxMember)
        {
            DB::beginTransaction();
            try {
                $user =WxMembership::create([
                    'wx_user_id' => Session::get('wx_user_id'),
                    'level' => 0,
                    'score' => 0,
                    'accumulated_score' => 0
                ]);
                $this->createWxScoreVariation($user->id,0,'注册',WxScoreVariation::TYPE_ACTIVITY,200);
                $this->changeWxMembershipScore(200);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e);
                return '我也不知道为什么，就是出错了';
            }

        }
        $activId = 1;
        $hasscan = WxScoreVariation::where('wx_score_activity_id', $activId)->get()->first();
        if(!$hasscan)
        {
            $activ = WxScoreActivity::find($activId);
            $user = WxUser::find(Session::get('wx_user_id'));
            $this->createWxScoreVariation($user->wxMembership->id,$activId,$activ->name,WxScoreVariation::TYPE_ACTIVITY,$activ->score);
            $this->changeWxMembershipScore($activ->score);
            $tips = '领取成功';
            return $this->user($tips);
        }
        else
        {
            $tips = '已经领取过了';
            return $this->user($tips);
        };

    }

    public function createWxScoreVariation($memid,$activId,$name,$type,$score)
    {
        WxScoreVariation::create([
            'wx_membership_id' => $memid,
            'wx_score_activity_id' => $activId,
            'name' => $name,
            'type' => $type,
            'score' => $score
        ]);
    }

    private function changeWxMembershipScore($score)
    {
        $user = WxUser::find(Session::get('wx_user_id'));
        $user->wxMembership->score = $user->wxMembership->score+$score;
        $user->wxMembership->accumulated_score = $user->wxMembership->accumulated_score+$score;
        $user->wxMembership->save();
        app('MembershipService')->upgradeWxMembershipLevelIfNeeded($user->wxMembership);
    }

    /**
     * A casa for user to view on wechat index page should have the least price and thumnail.
     */
    private function convertToViewCasa(WxCasa $casa)
    {
        $casa->cheapestPrice = DB::table('wx_room')->where('wx_casa_id', $casa->id)->min('price');
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

    public function logout() {
        Session::forget('wx_user_id');
        Session::forget('openid');
        return redirect('/wx/user');
    }
}

<?php

namespace App\Http\Controllers\Wx;


use App\Entity\Wx\WxScoreActivity;
use App\Entity\Wx\WxScoreVariation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxMembership;
use App\Entity\Wx\WxCollection;

/**  */
class WxSiteController extends WxBaseController
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
        $user = User::find(Session::get('user_id'));
        $testWxCasas = array();
        if ($user->test) {
            $testWxCasas = WxCasa::where('test', 1)->orderBy('id', 'desc')->get();
            foreach ($testWxCasas as $casa) {
                $this->convertToViewCasa($casa);
            }
        }
        return view('wx.wxIndex', compact('wxCasas', 'testWxCasas'));
    }

    /**
     * Collect normal casas and test casas.
     * Will show test casas if the user is a test user.
     * @param int $id
     * @param int $collection
     */
    public function casa($id, $collection = 0)
    {
        $userId = Session::get('user_id');
        $wxCasa = WxCasa::find($id);
        $wxCasa->rooms = $wxCasa->rooms();
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        $casas = WxCollection::where('user_id', $userId)->where('wx_casa_id', $id)->first();
        if ($collection == 1 && empty($casas)) {
            $wxcollection = new WxCollection;
            $wxcollection->user_id = $userId;
            $wxcollection->wx_casa_id = $id;
            $wxcollection->save();
            $casas = 1;
        }
        return view('wx.wxCasaDetail', compact('wxCasa','casas'));
    }

    public function cardCasa($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('wx.cardCasa', compact('wxCasa','casas'));
    }

    /** @param string $tips */
    public function user($tips = null)
    {
        $user = User::find(Session::get('user_id'));
        $orders = Order::where('user_id', Session::get('user_id'))->orderBy('id', 'desc')->get();
        $percent = 0;
        if (!empty($user->wxMembership->id)) {
            $accumulatedScore = $user->wxMembership->accumulated_score;
            $percent = $accumulatedScore
                / WxMembership::getLevelDetail($user->wxMembership->level + 1)['score']
                * 100;
            $levelStr = WxMembership::getLevelDetail($user->wxMembership->level)['name'];
        }
        return view('wx.wxUser', compact('orders', 'user','percent', 'levelStr','tips'));
    }

    /** @param int $id */
    public function order($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->rooms = $wxCasa->rooms();
        $user = User::find(Session::get('user_id'));
        $date = new Carbon();
        // 下个月末
        $date->setDate($date->year, $date->month + 2, 0);
        $endDate = $date->format("Y年m月d日");
        return view('wx.wxCasaPrepareOrder', compact('wxCasa', 'user', 'endDate'));
    }

    /** 积分详情页面 */
    public function scoreVariation()
    {
        $userid = Session::get('user_id');
        return view('wx.scoreVariation', compact('userid'));
    }

    /** 积分详情的json数据
     *  @param int $user_id
     */
    public function scoreVariationJson($user_id)
    {
        $user = User::find($user_id);
        $scores = $user->wxScoreVariation()->orderBy('id','desc')->simplePaginate(15);
        foreach($scores as $score)
        {
            $score->money = $score->score;
            $score->time = $score->created_at->format('Y-m-d H:i');
        }
        return response()->json($scores);
    }

    /**
     * 注册成为会员
     * @param Request $request
     * */
    public function registerMember(Request $request)
    {
        $wxMember = User::find(Session::get('user_id'))->wxMembership;
        if($wxMember)
        {
            return redirect('/wx/user');
        };
        $user =WxMembership::create([
            'user_id' => Session::get('user_id'),
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
     * @param Request $request
     * */
    public function creditScore(Request $request)
    {

        $wxMember = User::find(Session::get('user_id'))->wxMembership;
        if(!$wxMember)
        {
            $user =WxMembership::create([
                'user_id' => Session::get('user_id'),
                'level' => 0,
                'score' => 0,
                'accumulated_score' => 0
            ]);
            $this->createWxScoreVariation($user->id,0,'注册',WxScoreVariation::TYPE_ACTIVITY,200);
            $this->changeWxMembershipScore(200);

        }
        $activId = 1;
        $user = User::find(Session::get('user_id'));
        $hasscan = $user->wxScoreVariation()->where('wx_score_activity_id', $activId)->get()->first();
        if(!$hasscan)
        {
            $activ = WxScoreActivity::find($activId);
            $user = User::find(Session::get('user_id'));
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
    /** */
    public function collection() {
        $userId = Session::get('user_id');
        $casas = WxCollection::where('user_id',$userId)->get();
        foreach ($casas as $casa) {
            $this->convertToViewCasa($casa->wxCasa);
        }
        return view('wx.collection',compact('casas'));
    }
    /** @param Request $request */
    public function collectionDel(Request $request) {
        $userId = Session::get('user_id');
        $saves=$request->all();
        foreach($saves['casa'] as $key=>$casa){
            if($casa==1){
                WxCollection::where('user_id',$userId)->
                where('wx_casa_id',$key)->delete();
            }
        }
        return redirect('wx/collection');
    }

    /** */
    public function logout() {
        Session::forget('user_id');
        Session::forget('openid');
        return "已退出";
    }

    private function createWxScoreVariation($memid, $activId, $name, $type, $score)
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
        $user = User::find(Session::get('user_id'));
        $user->wxMembership->score = $user->wxMembership->score+$score;
        $user->wxMembership->accumulated_score = $user->wxMembership->accumulated_score+$score;
        $user->wxMembership->save();
        app('MembershipService')->upgradeWxMembershipLevelIfNeeded($user->wxMembership);
    }
}

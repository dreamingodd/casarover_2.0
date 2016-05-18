<?php

namespace App\Http\Controllers\Wx;


use DB;
use Session;
use App\Entity\Wx\WxUser;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxMembership;

class WxSiteController extends Controller
{
    public function index()
    {
        $wxCasas = WxCasa::orderBy('id', 'desc')->get();
        foreach ($wxCasas as $casa) {
            $this->convertToViewCasa($casa);
        }
        return view('wx.wxIndex', compact('wxCasas'));
    }

    public function casa($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('wx.wxCasaDetail', compact('wxCasa'));
    }

    public function user()
    {
        $wxUser = WxUser::find(Session::get('wx_user_id'));
        $orders = WxOrder::where('wx_user_id', Session::get('wx_user_id'))->orderBy('id', 'desc')->get();
        return view('wx.wxUser', compact('orders', 'wxUser'));
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
        $scores = $user->WxscoreVariation()->simplePaginate(15);
        foreach($scores as $score)
        {
            $score->money = $score->score;
            $score->time = $score->created_at;
//            $score->time = $score->created_at->format('Y-m-d H:i');
        }
        return response()->json($scores);
    }

    /**
     * 注册成为会员
     * */
    public function registerMember()
    {
//        $wxMember = WxMembership::where('wx_user_id',Session::get('wx_user_id'))->get();
//        dd(isset($wxMember->wx_user_id));
//        if(!isset($wxMember))
//        {
//            return '已经是会员了';
//        };
//        return WxMembership::create([
//            'wx_user_id' => Session::get('wx_user_id'),
//            'level' => 1,
//            'score' => 0,
//            'accumulated_score' => 0
//        ]);
    }
    /**
     * 扫名片获得积分
     * 如果是第二次扫的提示已经扫过了
     * */
    public function creditScore()
    {
        $this->registerMember();
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
}

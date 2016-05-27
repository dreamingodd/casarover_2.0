<?php

namespace App\Http\Controllers\Wx;

use Config;
use Log;
use App\Common\WxTools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxUser;
use App\Entity\Wx\WxActivityCasa;
use App\Entity\Wx\WxVote;
use DB;
use Session;

class ActivityController extends Controller
{
    use WxTools;

    public function index()
    {
        $data = WxCasa::where('activ',1)->get();
        foreach ($data as $casa) {
            $this->convertToViewCasa($casa);
        }
        return view('activity.index',compact('data'));
    }
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

    public function show($id)
    {
        $wxCasa = WxCasa::find($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        return view('activity.casa',compact('wxCasa'));
    }

    public function person($id=0)
    {
        $userId=Session::get('wx_user_id');
        if($id==0){
            $casas = WxCasa::where('activ',1)->get();
            foreach ($casas as $casa) {
                $this->convertToViewCasa($casa);
            }
        }
        else {
            $casas18 = WxActivityCasa::where('wx_user_id', $userId)->get();
            $casas=array();
            foreach ($casas18 as $key=>$casa) {
                $casas[$key]=$casa->wxCasa;
                $casas[$key]->vote=$casa->vote;
                $this->convertToViewCasa($casas[$key]);
            }
        $user=WxUser::find($userId);
        }
        return view('activity.person',compact('casas','user','id'));
    }
    public function rank($id=0)
    {
        $userId=Session::get('wx_user_id');
        $users = WxActivityCasa::where('wx_casa_id', $id)->orderBy('vote', 'DESC')->get();
        $user=WxUser::find($userId);
        $user->vote=WxActivityCasa::where('wx_user_id', $userId)->value('vote');
        $casa = WxCasa::find($id);
        $this->convertToViewCasa($casa);
        return view('activity.rank',compact('users','user','casa'));
    }

    public function datesleep()
    {
        return view('activity.datesleep');
    }

    //后台活动index
    public function selcasas()
    {
        $casas = WxCasa::all();
        return view('backstage.selCasas',compact('casas'));
    }
    //已选择列表
    public function sellist()
    {
        $data = WxCasa::where('activ',1)->get();
        return response()->json($data);
    }
    //后台添加
    public function add($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = 1;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }
    //后台删除
    public function del($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = null;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }

    public function subscribeTest()
    {
        $user = WxUser::get(Session::get('wx_user_id'));
        $json = WxTools::getBaseAccessToken(Config::get('casarover.wx_appid'), Config::get('casarover.wx_appsecret'));
        Log::info(json_decode($json));
    }
}

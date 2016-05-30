<?php

namespace App\Http\Controllers\Wx;

use Exception;
use App\Entity\Wx\WxUser;
use Config;
use Log;
use DB;
use Session;
use App\Common\WxTools;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxActivityCasa;
use App\Entity\Wx\WxVote;

class Activity18Controller extends WxBaseController
{
    use WxTools;

    public function index()
    {
        $data = WxCasa::where('activ',1)->get();
        foreach ($data as $casa) {
            $this->convertToViewCasa($casa);
            $casa->totalVotes = WxActivityCasa::where('wx_casa_id',$casa->id)->get();
        }
        return view('activity.index',compact('data'));
    }

    public function show($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->banner = $this->banner($id);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        $check = $this->checkSubscription();
        //检查是否已经约过了
        $hassleep = WxActivityCasa::where('wx_user_id',Session::get('wx_user_id'))->where('wx_casa_id',$id)->first();
        return view('activity.casa',compact('wxCasa','hassleep','check'));
    }

    /**
     * banner config
     * key => value
     * key is wxcasa_id
     **/
    private function banner($id)
    {
        try {
            // 民宿图片
            return Config::get('config.wx_18_pics')[$id];
        } catch (Exception $e) {
            // 默认图片
            return 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/banner.png';
        }
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

                //此处需改用数据库查排名
                $samecasas=WxActivityCasa::where('wx_casa_id',$casa->wxCasa->id)->orderBy('vote', 'DESC')->get();
                foreach($samecasas as $keys=>$somecasa){
                  if($somecasa->wx_user_id==$userId) {
                      $casas[$key]->rank = $keys + 1;
                      break;
                  }
                }
                //

                $this->convertToViewCasa($casas[$key]);
            }
        $user=WxUser::find($userId);
        }
        return view('activity.person',compact('casas','user','id'));
    }

    public function rank($id=0)
    {
        $userId=Session::get('wx_user_id');
        $check=WxActivityCasa::where('wx_casa_id', $id)->where('wx_user_id', $userId)->first();
        $user=WxUser::find($userId);
        $user->vote=WxActivityCasa::where('wx_user_id', $userId)->where('wx_casa_id', $id)->value('vote');
        $users = WxActivityCasa::where('wx_casa_id', $id)->orderBy('vote', 'DESC')->get();
        //此处需改用数据库查排名
        foreach($users as $key=>$person){
            if($person->wx_user_id==$userId) {
                $user->rank = $key + 1;
                break;
            }
        }
        //
        $casa = WxCasa::find($id);
        $this->convertToViewCasa($casa);
        return view('activity.rank',compact('users','user','casa','check'));
    }

    public function datesleep($casa_id, $user_id)
    {
        //存储信息
        $hassleep = WxActivityCasa::where('wx_user_id',$user_id)->where('wx_casa_id',$casa_id)->first();
        if(!$hassleep) {
            DB::beginTransaction();
            try {
                $sleep = new WxActivityCasa();
                $sleep->wx_user_id = Session::get('wx_user_id');
                $sleep->wx_casa_id = $casa_id;
                $sleep->vote = 1;
                $sleep->save();
                DB::commit();
            } catch(\Exception $e) {
                DB::rollback();
                Log::error($e);
                //出错应该到错误页面不应该是404
                abort(404);
            }
        }
        $wxCasa = WxCasa::find($casa_id);
        $user = WxUser::find($user_id);
        $isme = Session::get('wx_user_id') == $user_id?1:0;
        //  $isme = 0;
        $check = $this->checkSubscription();
        return view('activity.datesleep',compact('wxCasa','user','isme','check'));
    }

    public function poll($casa_id, $user_id)
    {

        /**
         * code
         * 0 投票成功
         * 1 投票时间不允许
         * */
        $activitycasa = WxActivityCasa::where('wx_casa_id',$casa_id)->where('wx_user_id',$user_id)->first();
        //时间判定
        $lastpoll = WxVote::where('wx_user_id',Session::get('wx_user_id'))->where('18_id',$activitycasa->id)->get()->last();
        if($lastpoll)
        {
            //今天零点的时间戳
            $today = strtotime(date('Y-m-d'));
            //最后一次投票的时间戳
            $lastpollTime = strtotime($lastpoll->created_at);
            if($lastpollTime > $today)
            {
                return response()->json(['code'=>'1']);
            }
        }

        WxVote::create([
            '18_id' => $activitycasa->id,
            'wx_user_id' => Session::get('wx_user_id')
        ]);

        return response()->json(['code'=>'0']);

    }

    // 后台活动index
    public function selcasas()
    {
        $casas = WxCasa::all();
        return view('backstage.selCasas',compact('casas'));
    }
    // 已选择列表
    public function sellist()
    {
        $data = WxCasa::where('activ',1)->get();
        return response()->json($data);
    }
    // 后台添加
    public function add($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = 1;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }
    // 后台删除
    public function del($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = null;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }

    public function checkSubscription()
    {
        $user = WxUser::find(Session::get('wx_user_id'));
        return $this->getSubscribe($user->openid);
    }
}

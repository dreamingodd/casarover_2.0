<?php

namespace App\Http\Controllers\Wx;

use Exception;
use App\Entity\User;
use Config;
use Log;
use DB;
use Session;
use App\Common\WxTools;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\Wx18;
use App\Entity\Wx\WxVote;

/**
 * Controller for 18家民宿约睡活动.
 */
class Activity18Controller extends WxBaseController
{
    use WxTools;

    /** 首页 */
    public function index()
    {
        $casas = WxCasa::where('activ', 1)->orderBy('display_order')->get();
        $data = array();
        foreach ($casas as $casa) {
            $this->convertToViewCasa($casa);
            $casa->participantCount = Wx18::where('wx_casa_id', $casa->id)->count();
            $casa->voteCount = Wx18::where('wx_casa_id', $casa->id)->sum('vote');
            array_push($data, $casa);
        }
        usort($data, function($c1, $c2) {
            if ($c1->voteCount == $c2->voteCount) {
                if ($c1->participantCount == $c2->participantCount) {
                    return $c1->display_order > $c2->display_order;
                }
                return $c1->participantCount < $c2->participantCount;
            }
            return $c1->voteCount < $c2->voteCount;
        });
        return view('activity.index', compact('data'));
    }

    /** 民宿页.
     * @param int $id WxCasa's id
     */
    public function show($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->banner = $this->banner($wxCasa->name);
        $this->convertToViewCasa($wxCasa);
        $wxCasa->contents = $wxCasa->contents()->orderBy('id')->get();
        $check = $this->checkSubscription();
        //检查是否已经约过了
        $hassleep = Wx18::where('user_id', Session::get('user_id'))->where('wx_casa_id', $id)->first();
        return view('activity.casa', compact('wxCasa','hassleep','check'));
    }

    /**
     * @param int $id User's id
     */
    public function rankEntry($id = 0)
    {
        $user = User::find(Session::get('user_id'));
        if ($id == 0) {
            $casas18 = WxCasa::where('activ', 1)->get();
        } else {
            $casas18 = Wx18::where('user_id', $user->id)->get();
        }
        $casas = array();
        foreach ($casas18 as $key => $casa18) {
            $casa = $casa18->wxCasa == null ? $casa18 : $casa18->wxCasa;
            $result = DB::select(
                "SELECT * FROM ("
                    ." SELECT @rownum := @rownum + 1 rank, u.id, u.headimgurl, u.nickname, wx18.vote"
                    ." FROM wx_user_casa_18 wx18, user u, (SELECT@rownum :=0) r"
                    ." WHERE wx18.user_id = u.id and wx_casa_id = $casa->id"
                    ." ORDER BY wx18.vote DESC"
                ." ) all_rank WHERE all_rank.id = $user->id"
            );
            if (count($result) > 0) {
                $casa->rank = $result[0]->rank;
            }
            $this->convertToViewCasa($casa);
            array_push($casas, $casa);
        }
        return view('activity.rankEntry',compact('casas','user','id'));
    }

    /**
     * @param int $casaId WxCasa's id
     */
    public function rank($casaId = 0)
    {
        $userId = Session::get('user_id');
        $user = User::find($userId);
        $casa = WxCasa::find($casaId);
        $wx18s = Wx18::where('wx_casa_id', $casaId)->orderBy('vote', 'DESC')->get();
        //此处需改用数据库查排名
        $result = DB::select(
            "SELECT * FROM ("
                ." SELECT @rownum := @rownum + 1 rank, u.id, u.headimgurl, u.nickname, wx18.vote"
                ." FROM wx_user_casa_18 wx18, user u, (SELECT@rownum :=0) r"
                ." WHERE wx18.user_id = u.id and wx_casa_id = $casa->id"
                ." ORDER BY wx18.vote DESC"
            ." ) all_rank WHERE all_rank.id = $user->id"
        );
        $myRawWx18 = null;
        if (count($result) > 0) {
            $myRawWx18 = $result[0];
        }
        foreach($wx18s as $key => $wx18){
            if($wx18->user_id == $userId) {
                $user->rank = $key + 1;
                break;
            }
        }
        $myWx18 = Wx18::where('user_id', $user->id)->first();
        $this->convertToViewCasa($casa);
        return view('activity.rank',compact('wx18s','myRawWx18','casa'));
    }

    /** 约睡
     * @param int $casa_id
     * @param int $user_id
     */
    public function datesleep($casa_id, $user_id)
    {
        //存储信息
        $hassleep = Wx18::where('user_id', $user_id)->where('wx_casa_id', $casa_id)->first();
        if(!$hassleep) {
            DB::beginTransaction();
            try {
                $sleep = new Wx18();
                $sleep->user_id = Session::get('user_id');
                $sleep->wx_casa_id = $casa_id;
                $sleep->vote = 0;
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
        $user = User::find($user_id);
        $isme = Session::get('user_id') == $user_id ? 1 : 0;
        //  $isme = 0;
        $check = $this->checkSubscription();
        return view('activity.datesleep',compact('wxCasa', 'user', 'isme', 'check'));
    }

    /**
     * @param int $casa_id
     * @param int $user_id
     * @return 0 投票成功, 1 投票时间不允许, TODO 2 未关注
     * */
    public function vote($casa_id, $user_id)
    {
        $activitycasa = Wx18::where('wx_casa_id',$casa_id)->where('user_id',$user_id)->first();
        //时间判定
        $lastpoll = WxVote::where('user_id',Session::get('user_id'))
                ->where('18_id',$activitycasa->id)->get()->last();
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
            'user_id' => Session::get('user_id')
        ]);
        $activitycasa->vote += 1;
        $activitycasa->save();

        return response()->json(['code'=>'0']);

    }

    /** 后台活动 index */
    public function selcasas()
    {
        $casas = WxCasa::all();
        return view('backstage.selCasas',compact('casas'));
    }
    /** 已选择列表 */
    public function sellist()
    {
        $data = WxCasa::where('activ', 1)->orderBy('display_order')->get();
        return response()->json($data);
    }
    /**
     * 后台添加
     * @param int $id
     */
    public function add($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = 1;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }
    /** 后台删除
     * @param int $id
     */
    public function del($id)
    {
        $wxCasa = WxCasa::find($id);
        $wxCasa->activ = null;
        $wxCasa->save();
        $data = ['msg','ok'];
        return response()->json($data);
    }

    /** 检查关注 */
    public function checkSubscription()
    {
        $user = User::find(Session::get('user_id'));
        return $this->getSubscribe($user->openid);
    }

    /**
     * banner config
     * key is wxcasa->name
     * @param string $name WxCasa's name
     **/
    private function banner($name)
    {
        try {
            // 民宿图片
            return Config::get('config.wx_18_pics')[$name];
        } catch (Exception $e) {
            // 默认图片
            return 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/banner.jpg';
        }
    }

}

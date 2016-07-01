<?php

namespace App\Http\Controllers\Wx;

use DB;
use App\Http\Controllers\Controller;
use App\Entity\User;

use Illuminate\Http\Request;
/**
 *
 */
class DateSleepStatController extends Controller
{
    public function result() {
        $result = DB::select("SELECT wuc.id 18_id, u.id user_id, u.nickname, u.headimgurl, u.cellphone, wc.name casaname, mr.vote "
          ."FROM user u, wx_casa wc, wx_user_casa_18 wuc, "
                ."(SELECT max(wuc.vote) vote, wx_casa_id "
                ."FROM wx_user_casa_18 wuc "
                ."GROUP BY wx_casa_id) mr "
         ."WHERE u.id = wuc.user_id "
           ."AND wc.id = wuc.wx_casa_id "
           ."AND wuc.vote = mr.vote "
           ."AND wuc.wx_casa_id = mr.wx_casa_id "
           ."AND mr.vote > 1 "
         ."ORDER BY mr.vote DESC");
        return view('backstage.system.dateSleepResult', compact(['result']));
    }

    public function voteRecords($userId) {
        $result = DB::select("SELECT wv.created_at, u2.nickname, wc.name casa_name "
                             ."FROM wx_user_casa_18 wuc, user u, wx_casa wc, wx_vote wv, user u2 "
                            ."WHERE wuc.wx_casa_id = wc.id "
                              ."AND wuc.user_id = u.id "
                              ."AND wv.18_id = wuc.id "
                              ."AND wv.user_id = u2.id "
                              ."AND u.id = " . $userId
                              ." ORDER BY created_at DESC");
        $count = count($result);
        $username = User::find($userId)->nickname;
        return view('backstage.system.dateSleepRecords', compact(['result', 'count', 'username']));
    }
}

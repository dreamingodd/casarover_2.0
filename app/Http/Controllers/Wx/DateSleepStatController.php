<?php

namespace App\Http\Controllers\Wx;

use DB;
use stdClass;
use App\Entity\Wx\Wx18;
use App\Entity\Wx\WxVote;
use App\Http\Controllers\Controller;
use App\Entity\User;

/**
 *
 */
class DateSleepStatController extends Controller
{
    /**
     *
     */
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

    /**
     *
     */
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

    /**
     * 有点长，两部分一模一样 ^·^
     */
    public function analyze() {
        // 第一部分: datesleep
        $dateRecords = Wx18::all();
        $dateDataArray = array();
        foreach ($dateRecords as $record) {
            $key = $record->created_at->format('m-d');
            if (array_key_exists($key, $dateDataArray)) {
                $dateDataArray[$key]->quantity++;
            } else {
                $dateDataArray[$key] = new stdClass();
                $dateDataArray[$key]->quantity = 1;
                $dateDataArray[$key]->virginQuantity = 0;
            }
        }
        $dateVirginRecords = DB::select("select * from wx_user_casa_18 group by user_id");
        foreach ($dateVirginRecords as $record) {
            $key = substr($record->created_at, 5, 5);
            if (array_key_exists($key, $dateDataArray)) {
                $dateDataArray[$key]->virginQuantity++;
            }
        }
        $dateData = json_encode($dateDataArray);
        $dateCount = count($dateRecords);
        $dateVirginCount = count($dateVirginRecords);
        // 第二部分: vote
        $voteRecords = WxVote::all();
        $voteDataArray = array();
        foreach ($voteRecords as $record) {
            $key = $record->created_at->format('m-d');
            if (array_key_exists($key, $voteDataArray)) {
                $voteDataArray[$key]->quantity++;
            } else {
                $voteDataArray[$key] = new stdClass();
                $voteDataArray[$key]->quantity = 1;
                $voteDataArray[$key]->virginQuantity = 0;
            }
        }
        $voteVirginRecords = DB::select("select * from wx_vote group by user_id");
        foreach ($voteVirginRecords as $record) {
            $key = substr($record->created_at, 5, 5);
            if (array_key_exists($key, $voteDataArray)) {
                $voteDataArray[$key]->virginQuantity++;
            }
        }
        $voteData = json_encode($voteDataArray);
        $voteCount = count($voteRecords);
        $voteVirginCount = count($voteVirginRecords);

        return view('backstage.system.dateSleepAnalyze',
                compact(['dateData', 'dateCount', 'dateVirginCount', 'voteData', 'voteCount', 'voteVirginCount']));
    }
}

<?php

namespace App\Http\Controllers\Merchant;

use DB;
use App\Common\RandomString;
use App\Entity\Dealer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/** 经销商管理 */
class DealerController extends Controller
{
    /** The very dealer's index page. */
    public function index() {

    }

    public function statDeal() {
        app('DealerVacationRelationService')->add(3, 138);
        return view('backstage.dealerStatDeal', compact('stats'));
    }

    /** Backstage dealer selling result statistics. */
    public function statCoupon() {
        $stats = DB::select(
        "select * from dealer left join"
        ." (select requested.dealer_id, requested.requested_count, used.used_count from"
            ." (select dealer_id, count(*) requested_count from coupon where status in (0,1) group by dealer_id) requested"
            ." left join"
            ." (select dealer_id, count(*) used_count from coupon where status = 1 group by dealer_id) used"
            ." on requested.dealer_id = used.dealer_id"
        ." ) stat on dealer.id = stat.dealer_id"
        );
        dd($stats);
        return view('backstage.dealerStatCoupon', compact('stats'));
    }

    public function showList()
    {
        $dealers = Dealer::all();
        $jsonDealers = json_encode($dealers);
        return view('backstage.dealerList', compact(['jsonDealers']));
    }

    /** 进入编辑页面 */
    public function edit($id = 0) {
        if ($id) $dealer = Dealer::find($id);
        else $dealer = new Dealer();
        return view('backstage.dealerEdit', compact('dealer'));
    }

    /** 抛constraint异常表示name或code唯一性问题 */
    public function update(Request $request, $id = 0)
    {
        $name = $request->name;
        $code = $request->code;
        if (!$name || !$code) return "不能为空！";
        if ($id) {
            $dealer = Dealer::find($id);
            $dealer->name = $name;
            $dealer->code = $code;
            $dealer->save();
        }
        // 新建
        else {
            $key = RandomString::get(Dealer::KEY_LENGTH);
            $devKey = RandomString::get(4);
            Dealer::create([
                'name' => $name,
                'code' => $code,
                'key' => $key,
                'dev_key' => $devKey,
            ]);
        }
        return redirect('/back/dealer/list');
    }
}

<?php

namespace App\Http\Controllers\Merchant;

use DB;
use Session;
use App\Common\RandomString;
use App\Entity\Coupon;
use App\Entity\Dealer;
use App\Entity\Order;
use App\Entity\Wx\WxBind;
use App\Entity\VacationCard;
use App\Entity\Relation\DealerVacationRelation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/** 经销商管理 */
class DealerController extends Controller
{
    /** The very dealer's index page. */
    public function index() {
        $userId = Session::get('user_id');
        $wxBind = WxBind::where('user_id', $userId)->get()->first();
        $cardList = [];
        $couponList = [];
        $cardTotal = 0;
        $usedCouponCount = 0;
        if ($wxBind && $wxBind->dealer_id) {
            $dealer = Dealer::find($wxBind->dealer_id);
            if ($dealer->deal_mode) {
                $relationList = DealerVacationRelation::where('dealer_id', $dealer->id)->get();
                foreach ($relationList as $card) {
                    $vacationCard = VacationCard::where('order_id', $card->vacation_card_order_id)->get()->first();
                    if ($vacationCard->order->status == Order::STATUS_PAYED) {
                        $card->card_no = $vacationCard->card_no;
                        $card->realname = $vacationCard->order->user->username;
                        $card->nickname = $vacationCard->order->user->nickname;
                        $card->cellphone = $vacationCard->order->user->cellphone;
                        $card->total = $vacationCard->order->total;
                        $card->created_at = $vacationCard->order->created_at;
                        $cardTotal += $card->total;
                        array_push($cardList, $card);
                    }
                }
            }
            if ($dealer->coupon_mode) {
                $couponList = Coupon::where('dealer_id', $dealer->id)->where('status', '<', 2)->get();
                $usedCouponCount = Coupon::where('dealer_id', $dealer->id)->where('status', Coupon::STATUS_USED)->count();
            }
        }
        return view('merchant.dealerIndex', compact(['wxBind', 'cardList', 'couponList', 'dealer',
                'cardTotal', 'usedCouponCount']));
    }

    public function statDeal() {
        $stats = DB::select(
        "select * from dealer left join"
        ." (select dvr.dealer_id, count(*) count, sum(total) total from dealer_vacation_relation dvr, dealer, `order`"
        ."  where dvr.dealer_id = dealer.id and dvr.vacation_card_order_id = order.id and status = 1 group by dealer.id"
        ." ) stat on dealer.id = stat.dealer_id where dealer.deal_mode = 1;"
        );
        // I consider this process should not be here.
        foreach ($stats as $stat) {
            $commission = 0;
            $total = $stat->total;
            if ($total > 40000) {
                $commission += ($total - 40000) * 0.1;
                $total = 40000;
            }
            if ($total > 25000) {
                $commission += ($total - 25000) * 0.08;
                $total = 25000;
            }
            if ($total > 10000) {
                $commission += ($total - 10000) * 0.05;
                $total = 10000;
            }
            $commission = round($commission + $total * 0.03);
            $stat->commission = $commission;
        }
        return view('backstage.dealerStatDeal', compact('stats'));
    }

    /** Backstage dealer selling result statistics. */
    public function statCoupon() {
        $stats = DB::select(
        "select * from dealer left join"
        ." (select requested.dealer_id, requested.requested_count, used.used_count,"
        ."  requested.requested_total, used.used_total from"
            ." (select dealer_id, count(*) requested_count, sum(price) requested_total"
            ."  from coupon where status in (0,1) group by dealer_id) requested"
            ." left join"
            ." (select dealer_id, count(*) used_count, sum(price) used_total"
            ."  from coupon where status = 1 group by dealer_id) used"
            ." on requested.dealer_id = used.dealer_id"
        ." ) stat on dealer.id = stat.dealer_id where coupon_mode = 1"
        );
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
    public function update(Request $request)
    {
        $name = $request->name;
        $code = $request->code;
        $id = $request->id;
        if (!$name || !$code) return "不能为空！";
        if ($id) {
            $dealer = Dealer::find($id);
            $dealer->name = $name;
            $dealer->code = $code;
            $dealer->deal_mode = $request->deal_mode;
            $dealer->coupon_mode = $request->coupon_mode;
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
                'deal_mode' => $request->deal_mode,
                'coupon_mode' => $request->coupon_mode,
            ]);
        }
        return redirect('/back/dealer/list');
    }
}

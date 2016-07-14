<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\VacationCard;
use App\Entity\Order;
use App\Entity\User;
use Session;

class VacationCardController extends Controller
{
    public function cardList(Request $request)
    {
        $search = $request->input('query');
        $userId = Session::get('user_id');
        // find wxcasa_id
        $wxcaa = Wxbind::where('user_id',$userId)->first();
        // find order_items belong wxcasa
        $orderItems = WxCasa::find($wxcaa->wx_casa_id)->orderItems;
        // find all order_id belong the wxcasa
        $itemIds = [];
        $orderIds = [];
        foreach ($orderItems as $key ) {
            array_push($orderIds,$key->order_id);
            array_push($itemIds,$key->id);
        }
        // all vacation card order belong the wxcasa so it is also a card list
        $cards = Order::with('VacationCard','user')->where('type',Order::TYPE_VACATION_CARD)->whereIn('id',$orderIds)->paginate(10);
        // dd($cards);
        // 合并数据
        foreach ($cards as $card) {
            $card->card_no = $card->vacationCard->card_no;
            $card->goods = $card->orderItems()->whereIn('id',$itemIds)->get();
            foreach ($card->goods as $key ) {
                $key->left = $key->opportunity->left_quantity;
            }
            $card->username = $card->user->realname;
            $card->cellphone = $card->user->cellphone;
        }
        // $data = ['data' => $cards];
        return response()->json(['code' => 0, 'msg' => '获取成功','result' => $cards]);
    }
}

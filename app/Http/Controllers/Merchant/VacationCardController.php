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
use DB;
use App\Entity\Product;
use App\Entity\OrderItem;

class VacationCardController extends Controller
{
    public function cardList(Request $request)
    {
        $search = $request->input('query');
        $userId = Session::get('user_id');
        // find wxcasa_id
        $wxcaa = WxCasa::find(Wxbind::where('user_id',$userId)->first()->wx_casa_id);
        // find order_items belong wxcasa
        $orderItems = $wxcaa->orderItems;
        // find all order_id belong the wxcasa
        $itemIds = [];
        $orderIds = [];
        foreach ($orderItems as $key ) {
            array_push($orderIds,$key->order_id);
            array_push($itemIds,$key->id);
        }
        $cards = DB::table('order')->join('user',function($join){
            $join->on('order.user_id','=','user.id');
        })->join('vacation_card_order','order.id','=','vacation_card_order.order_id')
            ->select('user.realname','user.cellphone','order.*','vacation_card_order.*')
            ->where('status',Order::STATUS_PAYED)
            ->whereIn('order.id',$orderIds)
            ->where(function($q) use ($search){
                if($search != 'null'){
                    $q->where('card_no','like','%'.$search.'%')
                        ->orwhere('realname','like','%'.$search.'%')
                        ->orwhere('cellphone','like','%'.$search.'%');
                }
            })->paginate(10);

        // all vacation card order belong the wxcasa so it is also a card list
        // $cards = Order::with('VacationCard','user')->where('type',Order::TYPE_VACATION_CARD)->whereIn('id',$orderIds)->paginate(10);
        // 合并数据
        foreach ($cards as $card) {
            $card->goods = Order::find($card->order_id)->orderItems()->whereIn('id',$itemIds)->get();
            foreach ($card->goods as $key ) {
                $key->left = $key->opportunity->left_quantity;
            }
            $card->username = $card->realname;
            $card->cellphone = $card->cellphone;
        }
        $wxcaa->products;

        $products = $wxcaa->products->where('type',Product::TYPE_VACATION_CARD);
        foreach ($products as $product) {
            $orderItems = OrderItem::where('product_id',$product->id)->whereIn('id',$itemIds)->get();
            $sales = 0;
            $surplus = 0;
            foreach ($orderItems as $key ) {
                if(isset($key->opportunity->left_quantity)){
                    $surplus += $key->opportunity->left_quantity;
                    $sales += $key->quantity;
                }
            }
            $product->sales = $sales;
            $product->surplus = $surplus;
        }
        return response()->json(['code' => 0, 'msg' => '获取成功','result' => compact('cards','products')]);
    }
}

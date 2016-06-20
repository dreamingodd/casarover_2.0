<?php

namespace App\Http\Controllers\Mall;

use App\Entity\Opportunity;
use App\Entity\OrderItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Product;
use App\Entity\Order;
use App\Entity\Stock;
use DB;
//use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use Session;
use App\Entity\VacationCard;
use Carbon\Carbon;

/**
 * Class VacationCardController
 * @package App\Http\Controllers\Mail
 * 探庐者度假卡
 * 自定义包含的民宿
 */
class VacationCardController extends Controller
{
    //后台选择参与活动的民宿
    public function back()
    {
        $casas = WxCasa::all();
        return view('backstage.vacationCasalist',compact('casas'));
    }
    //后台获取已经选中的
    public function casalist()
    {
        $casalist = Product::where('type',Product::TYPE_VACATION_CARD)->get();
        foreach($casalist as $list)
        {
            $list->orig = $list->stock->orig;
            $list->surplus = $list->stock->surplus;
        }
        return response()->json($casalist);
    }

    public function create($id)
    {
        $casa = WxCasa::find($id);
        DB::beginTransaction();
        try
        {
            $product = Product::create([
                'parent_id' => $id,
                'attachment_id' => $casa->attachment_id,
                'type' => Product::TYPE_VACATION_CARD,
                'name' => $casa->name
            ]);
            Stock::create([
                'product_id' => $product->id,
                'surplus' => 0
            ]);
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
            Log::error($e);
        }
        return response()->json(['msg'=>'ok']);
    }

    public function del($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['msg'=>'ok']);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->price = $request->price;
        $product->stock->orig = $request->orig;
        $product->stock->surplus = $request->surplus;
        $product->stock->save();
        $result = $product->save();
        if($result)
        {
            return response()->json(['msg'=>'ok']);
        }
    }
    //前台获取
    public function index()
    {
        //当价格为0的时候不上线
        $casas = Product::where('type',Product::TYPE_VACATION_CARD)->where('price','>',0)->get();
        return view('wx.cardCasaList',compact('casas'));
    }

    public function showlist()
    {
        $casas = Product::where('type',Product::TYPE_VACATION_CARD)->where('price','>',0)->get();
        foreach($casas as $casa)
        {
            $casa->headImg = 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'.$casa->img->filepath;
            $casa->orig = $casa->stock->orig;
            $casa->room = 0;
            $casa->surplus = $casa->stock->surplus;
        }
        return response()->json($casas);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $wxCasa = WxCasa::find($product->parent_id)->contents;
        foreach($wxCasa as $casa){
            $casa->imgs = $casa->attachments;
        }
        return response()->json($wxCasa);
    }

    public function buy(Request $request)
    {
        $casas = $request->casas;
        if(!$this->checkNumber($casas))
        {
            return response()->json(['msg'=>'0']);
        }
        else
        {
            $userId = Session::get('user_id');
            $type = Product::TYPE_VACATION_CARD;
            $name = "度假卡";
            //取第一家民宿的图片
            $photo_path = $casas[0]["headImg"];
            $total = $this->roomTotal($casas);
            $status = Order::STATUS_UNPAYED;
            DB::beginTransaction();
            try
            {
                //1: 在order 中存入信息
                $order = $this->createOrder($userId,$type,$name,$photo_path,$total,$status);
                //2：在order_item 存入信息  在opportunity中存入机会次数
                $this->saveOrderItem($order,$casas);
                //3: 在vacation_card_order中存入度假卡的信息
                $cardNo = sprintf("1%05d", $order->id).mt_rand(0,9);
                $this->saveVacationCard($order->id,$cardNo);
                return response()->json(['code' => 0,'msg' => '存储成功']);
            }
            catch(Exception $e)
            {
                DB::rollback();
                Log::error($e);
                //不一定是什么错误，但是前台能做的就是重试。
                return response()->json(['code' => 503, 'msg' => '网络错误，请刷新重试']);
            }

        }
    }

    private function createOrder($userId,$type,$name,$photo_path,$total,$status)
    {
        $order = Order::create([
            'user_id' => $userId,
            'type' => $type,
            'name' => $name,
            'photo_path' => $photo_path,
            'total' => $total,
            'status' => $status
        ]);
        $order->order_id = config('casarover.wx_shopid').'-'.$order->id;
        $order->save();
        return $order;
    }

    private function roomTotal($casas)
    {
        $total = 0;
        foreach($casas as $casa)
        {
            $price = Product::find($casa["id"])->price;
            $number = $casa["room"];
            $total += $price*$number;
        }
        return $total;
    }
    private function checkNumber($casas)
    {
        $num = $casas;
        if(count($num) < 3)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    private function saveOrderItem($order,$casas)
    {
        foreach($casas as $casa)
        {
            $product = Product::find($casa["id"]);
            $item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $casa["id"],
                'name' => $product->name,
                'photo_path' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'.$casa["headImg"],
                'price' => $product->price,
                'quantity' => $casa["room"]
            ]);
            Opportunity::create([
                'order_item_id' => $item->id,
                'left_quantity' => $casa["room"]
            ]);
        }
    }

    private function saveVacationCard($orderId,$cardNo)
    {
        $days = config('VacationCard.validDays');
        $style = mt_rand(0,3);
        $start = Carbon::now();
        $end = Carbon::now()->addDays($days);
        VacationCard::create([
            'order_id' => $orderId,
            'card_no' => $cardNo,
            'style' => $style,
            'start_date' => $start,
            'expire_date' => $end
        ]);
    }
    public function card($id=0)
    {
        $userId = Session::get('user_id');
        $cards=Order::where('user_id',$userId)->where('type',2)->get();
        return view('wx.card',compact('cards'));
    }
    public function cardCasa($id=0)
    {
        $userId = Session::get('user_id');
        $cardCasas=Order::where('user_id',$userId)->where('type',2)->get();
        return view('wx.cardCasa',compact('cardCasas'));
    }
    public function address(){
        $address=WxCasa::all();
        $all=array();
        foreach($address as $key=>$one){
            $all[$key]=$one->desc;
            $number=strpos($all[$key],'【地址】');
            $newadd=substr($all[$key],$number);
            $one->address=$newadd;
            $one->save();
//            echo $newadd;
//            echo '<br>';
        }
    }
}

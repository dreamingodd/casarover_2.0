<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Product;
use App\Entity\Stock;
use App\Entity\Order;
use App\Entity\Opportunity;
use DB;
use Session;

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

    public function show($id)
    {
        $product = Product::find($id);
        $wxCasa = WxCasa::find($product->parent_id);
    }

    public function buy(Request $request)
    {

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

<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Artisan;
use App\Entity\Order;

class backcontroller extends Controller
{
    public function sucess($type=0,$id=0) {
        return view('backstage.sucess');
    }
    public function fail() {
        return view('backstage.fail');
    }

    public function dropVacationData()
    {
         DB::beginTransaction();
         try {
             DB::table('vc_order_relation')->delete();
             DB::table('vacation_card_order')->delete();
             DB::table('opportunity_apply')->delete();
             DB::table('opportunity')->delete();
             DB::table('dealer')->delete();
             DB::table('coupon')->delete();
             $orders = Order::where('type',2)->orWhere('pay_type',3)->get();
             $orderIds = [];
             foreach($orders as $order){
                 array_push($orderIds, $order->id);
             }
             DB::table('casa_order')->whereIn('order_id',$orderIds)->delete();
             DB::table('order_item')->whereIn('order_id',$orderIds)->delete();
             DB::table('order')->where('type',2)->orwhere('pay_type',3)->delete();
             DB::commit();
             return 'ok';
         } catch (Exception $e) {
             Log::error(get_class() . ' - ' . $e);
         }



    }
    public function deploy(Request $request)
    {
        if($request->token == env('DEPLOY_TOKEN')){
            $code = Artisan::call('deploy');
            if($code == 0){
                return 1;                
            }
        }else{
            return 0;
        }
    }
}

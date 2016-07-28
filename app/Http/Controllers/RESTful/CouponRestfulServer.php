<?php

namespace App\Http\Controllers\RESTful;

use DB;
use Exception;
use Log;
use stdClass;
use App\Entity\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class CouponRestfulServer extends Controller
{

    public function getNewCoupon(Request $request) {
        try {
            DB::beginTransaction();
            // Get request params.
            $dealerCode = $request->code;
            $dealerKey = $request->key;
            $price = $request->price;
            $dealerOrderId = $request->order_id;
            // Check Paramenters
            $couponService = app('CouponService');
            $check = $couponService->checkParameters($dealerCode, $dealerKey, $price, $dealerOrderId);
            // Main process
            if ($check == "PROD") {
                $coupon = $couponService->create($dealerCode, $price, $dealerOrderId, $check);
                $validDomain = $this->checkDomain();
                if ($validDomain) {
                    $returnObj = $this->generateReturnObj(200, 'Get new coupon successfully!', $coupon);
                } else {
                    $returnObj = $this->generateReturnObj(400, 'Domain mismatch error!');
                }
            }
            // Client use dev_key.
            else if ($check == "TEST") {
                $coupon = $couponService->create($dealerCode, $price, $dealerOrderId, $check);
                $returnObj = $this->generateReturnObj(200, 'Get test coupon!', $coupon);
            } else {
                $returnObj = $this->generateReturnObj(400, 'Invalid Request - ' . $check);
            }
            DB::commit();
            return response()->json($returnObj);
        } catch (Exception $e) {
            DB::rollback();
            Log::error(get_class() . '  ' . $e);
            $returnObj = $this->generateReturnObj(500, "Server Error - " . $e->getMessage());
            return response()->json($returnObj);
        }
    }

    /** Get existing coupon by code or order_id */
    public function getCoupon(Request $request) {
        try {
            $couponService = app('CouponService');
            $couponNo = $request->coupon_no;
            $dealerCode = $request->code;
            $orderId = $request->order_id;
            if ($couponNo || ($dealerCode && $orderId)) {
                if ($couponNo) {
                    $coupon = Coupon::where('code', $couponNo)->get()->first();
                } else {
                    $client_order_id = $dealerCode . $orderId;
                    $coupon = Coupon::where('client_order_id', $client_order_id)->get()->first();
                }
                if ($coupon) {
                    $data = new stdClass();
                    $data->code = $coupon->code;
                    $data->status = $coupon->status;
                    $data->price = $coupon->price;
                    if ($data->status == Coupon::STATUS_TEST) $data->status = 0;
                    $returnObj = $this->generateReturnObj(200, "Get coupon status successfully!");
                    $returnObj->data = $data;
                } else {
                    $returnObj = $this->generateReturnObj(200, "Coupon not found");
                    $returnObj->data = null;
                }
            } else {
                $returnObj = $this->generateReturnObj(400, "Invalid Request - coupon_no/code/order_id is empty!");
            }
            return response()->json($returnObj);
        } catch (Exception $e) {
            Log::error(get_class() . '  ' . $e);
            $returnObj = $this->generateReturnObj(500, "Server Error - " . $e->getMessage());
            return response()->json($returnObj);
        }
    }

    private function generateReturnObj($status, $status_message, $coupon = 0) {
        $returnObj = new stdClass();
        $returnObj->status = $status;
        $returnObj->status_message = $status_message;
        if ($coupon) {
            $data = new stdClass();
            $data->coupon_no = $coupon->code;
            $data->pwd = $coupon->key;
            $data->price = $coupon->price;
            $returnObj->data = $data;
        }
        return $returnObj;
    }

    /** TODO: Check caller's domain. */
    private function checkDomain() {
        return true;
    }
}

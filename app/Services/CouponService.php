<?php

namespace App\Services;

use Config;
use App\Common\CommonTools;
use App\Common\RandomString;
use App\Entity\Coupon;
use App\Entity\Dealer;

class CouponService {
    public function checkParameters($dealerCode, $dealerKey, $price, $orderId) {
        $prices = Config::get('config.coupon_prices');
        // Price error.
        if (!in_array($price, $prices)) return "Price level is not acceptable!";
        $dealer = Dealer::where('code', $dealerCode)->get()->first();
        // Code error.
        if (!$dealer) return "Code is not recognized!";
        $client_order_id = $dealerCode . $orderId;
        $coupon = Coupon::where('client_order_id', $client_order_id)->get()->first();
        // orderId error
        if($coupon) return "Duplicated order_id!";
        if ($dealer->key == $dealerKey) {
            return "PROD";
        } else if ($dealer->dev_key == $dealerKey) {
            return "TEST";
        } else {
            // Key error.
            return "Key does not match!";
        }
    }

    // public function checkKeyCode($dealerCode, $dealerKey) {
    //     $dealer = Dealer::where('code', $dealerCode)->get()->first();
    //     // Code error.
    //     if (!$dealer) return "Code is not recognized!";
    //     if ($dealer1 || $dealer2) {
    //         return "success";
    //     } else {
    //         // Key error.
    //         return "Key does not match!";
    //     }
    // }

    /** One shall invoke this method after he checked the parameters(function checkParameters). */
    public function create($dealerCode, $price, $orderId, $mode) {
        $coupon = new Coupon();
        $coupon->dealer_id = Dealer::where('code', $dealerCode)->get()->first()->id;
        $coupon->client_order_id = $dealerCode . $orderId;
        $coupon->key = RandomString::get(6);
        $coupon->price = $price;
        $coupon->left = $price;
        if ($mode == 'PROD') {
            $coupon->status = Coupon::STATUS_NEW;
        } else {
            $coupon->status = Coupon::STATUS_TEST;
        }
        $coupon->save();
        $coupon->code = $dealerCode . CommonTools::changeToStartWithZero($coupon->id, 6) . RandomString::get(2);
        $coupon->save();
        return $coupon;
    }

    public function consumeCouponIfUsed($orderId) {
        // 减去充值卡，如果有使用的话
        $coupon = Coupon::where("vacation_card_order_id", $orderId)->get();
        if($coupon){
            foreach ($coupon as $value) {
                $value->status = Coupon::STATUS_USED;
                $value->save();
            }
        }
    }
}

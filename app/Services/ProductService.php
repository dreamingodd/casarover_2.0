<?php

namespace App\Services;
use App\Entity\Order;
use App\Entity\Product;

class ProductService {

    public function minus($orderId)
    {
        // 在库存中减去对应的数量
        $orderItems = Order::find($orderId)->orderItems;
        foreach ($orderItems as $item ) {
            $product = Product::find($item->product_id)->stock;
            if($product){
                $product->surplus -= $item->quantity;
                $product->save();
            }
        }
    }

}

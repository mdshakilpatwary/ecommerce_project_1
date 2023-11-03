<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class ShoppingCart extends Controller
{
    public function addToCart(Request $request){
        $quantity = $request->quantity;
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();
    
        $data = [
            'id' => $product->id,
            'name' => $product->p_name,
            'price' => $product->p_price,
            'qty' => $quantity,
            'options' => [
                'p_image' => $product->p_image,
            ],
            
        ];
        Cart::add($data);
        
        cartArray();
        return redirect()->back();
    }

    public function addToCartDelete($id){
        
        Cart::remove($id);
        return redirect()->back();
  
}
}

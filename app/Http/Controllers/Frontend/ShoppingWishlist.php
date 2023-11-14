<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class ShoppingWishlist extends Controller
{
    public function addToWishlist(Request $request){
      
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();
    
        $data = [
            'id' => $product->id,
            'name' => $product->p_name,
            'price' => $product->p_price,
            'qty' => 1,
            'options' => [
                'p_image' => $product->p_image,
            ],
            
        ];
        Cart::instance('wishlist')->add($data);
        
        wishlistArray();
        return redirect()->back();
    }

    public function addToWishlistDelete($id){
        
        Cart::instance('wishlist')->remove($id);
        return redirect()->back();
  
}
}

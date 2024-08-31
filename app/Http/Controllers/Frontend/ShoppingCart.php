<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class ShoppingCart extends Controller
{
    public function addToCart(Request $request){
        $request->validate([
            'quantity' => 'required',
            
        ],
        [
            'name.required' => 'Quantity select is required',
            
        ]);
        $quantity = $request->quantity;
        $color = $request->color;
        $size = $request->size;
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();
    
        $data = [
            'id' => $product->id,
            'name' => $product->p_name,
            'price' => $product->p_sale_price,
            'qty' => $quantity,
            'options' => [
                'p_image' => $product->p_image,
                'color' => $request->has('color') ? $color : null,
                'size' => $request->has('size') ? $size : null,
            ],
            
        ];
        Cart::add($data);
        
        cartArray();
        return redirect()->back();
    }
    public function cartViewList(){
        return view('frontend.page.cart_view');
    }
    public function addToCartDelete($id){
        
        Cart::remove($id);
        return redirect()->back();
  
    }
    public function addToCartUpdate(Request $request,$id){
        $cart_qty_val = $request->cart_qty_val;
       
        
        $data = [
            'qty' => $cart_qty_val,
            
        ];
        Cart::update($id, $data);

        $cart_total_update =Cart::subtotal();
        
        return response()->json([
            'cart_total_update' => $cart_total_update,
            
           
        ]);
  
    }


}

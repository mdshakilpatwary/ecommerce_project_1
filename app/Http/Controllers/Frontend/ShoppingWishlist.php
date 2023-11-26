<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartWishlist;
use Auth;

class ShoppingWishlist extends Controller
{
    public function addToWishlist(Request $request){
      
        $id = $request->product_id;
        $product = Product::where('id', $id)->first();

        $wishlist =new CartWishlist;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->p_id = $product->id;
        $wishlist->p_name = $product->p_name;
        $wishlist->p_price = $product->p_price;
        $wishlist->p_image = $product->p_image;
        $wishlist->save();
        $userID =Auth::user()->id;
        wishlistArray();
        return redirect()->back();
        
    }

    public function addToWishlistDelete($id){
        $wishlistD =CartWishlist::findOrFail($id); 
        $wishlistD->delete(); 
        return redirect()->back();
        
        
  
}
}

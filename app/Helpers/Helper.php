<?php
use App\Models\CartWishlist;
use Illuminate\Support\Facades\Auth;

function cartArray(){
    $cartCollection =\Cart::content();
    return $cartCollection->toArray();
}
function wishlistArray(){
if(Auth::user()){
    $wishlistCollection = CartWishlist::where('user_id', Auth::user()->id)->get();
    return $wishlistCollection;
}


}
// function wishlistArray(){
//     $wishlistCollection =\Cart::content();
//     return $wishlistCollection->toArray();
// }

?>
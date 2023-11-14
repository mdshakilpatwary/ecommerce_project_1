<?php


function cartArray(){
    $cartCollection =\Cart::content();
    return $cartCollection->toArray();
}
function wishlistArray(){
    $wishlistCollection =\Cart::instance('wishlist')->content();
    return $wishlistCollection->toArray();
}
// function wishlistArray(){
//     $wishlistCollection =\Cart::content();
//     return $wishlistCollection->toArray();
// }

?>
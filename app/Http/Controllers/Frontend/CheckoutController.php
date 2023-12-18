<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingDetails;
use App\Models\PaymentMethod;
use App\Models\Order;
use App\Models\Product;
use App\Models\IncludeAnother;
use App\Models\User;
use App\Models\OrderDatails;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;
use Session;
use Cart;
use Auth;

class CheckoutController extends Controller
{
    public function index(){
        return view('frontend.page.checkout');
    }
    function shippingDetails(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'phone number is required',
            'address.required' => 'Address is required',
            'city.required' => 'City is required',
            'country.required' => 'Country is required',
            
        ]);
    
        $sId =ShippingDetails::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'zip_code' => $request->country,
            'description' => $request->description,
        ]);
        Session::put('sid',$sId);
        // pageaccess condition 
        $access_page = 'okay';
        Session::put('access_page',$access_page);
        // condition 
        return redirect('/product/payment');
    }
    function payment(){
        $cartCollection = Cart::content();
        $cartArray = $cartCollection->toArray();
        return view('frontend.page.payment', compact('cartArray'));

    }

    // place order and payment system 
    function placeOrder(Request $request){
        $user =User::where('role', 'Admin')->get();
        $request->validate([
            'payment' => 'required',
            'tarms_checbox' => 'required',
            
        ],
        [
            'payment.required' => 'Select payment method is required',
            'tarms_checbox.required' => 'Please select Trams and condition',
            
        ]);
        $paymentMethod =$request->payment;
        $paymentId =PaymentMethod::insertGetId([
            'paymentMethod' => $paymentMethod,
            'status'    => 'pending',
        ]);
        $shipping_charge =IncludeAnother::findOrFail(1);
        $orderId = Order::insertGetId([
            'customer_id' => Auth::user()->id,
            'shipping_id' =>Session::get('sid'),
            'payment_id' =>$paymentId,
            'total'   =>Cart::subtotal()+ $shipping_charge->shipping_charge_insite,
            'status'  => 'pending',
        ]);

        $cartCollection = Cart::content();
        foreach($cartCollection as $cartItem){
            OrderDatails::insert([
                'order_id' => $orderId,
                'product_id' => $cartItem->id,
                'product_name' =>$cartItem->name,
                'product_price' => $cartItem->price,
                'product_color' => $cartItem->options['color'],
                'product_size' => $cartItem->options['size'],
                'product_sale_qty' => $cartItem->qty,
            ]);
        $up = Product::find($cartItem->id);
        $up->p_qty = ($up->p_qty - $cartItem->qty);
        $up->update();


        }

        Session::flash('access_page');

        if($paymentMethod =='cash'){
            Cart::destroy();
            Notification::send($user, new OrderComplete($orderId));
            return view('frontend.page.orderMsg');
        }
        elseif($paymentMethod =='bkash'){
            Cart::destroy();
            Notification::send($user, new OrderComplete($orderId));
            return view('frontend.page.orderMsg');
        }
        elseif($paymentMethod =='nagod'){
            Cart::destroy();
            Notification::send($user, new OrderComplete($orderId));
            return view('frontend.page.orderMsg');
        }
        elseif($paymentMethod =='roket'){
            Cart::destroy();
            Notification::send($user, new OrderComplete($orderId));
            return view('frontend.page.orderMsg');
        }


    }
}

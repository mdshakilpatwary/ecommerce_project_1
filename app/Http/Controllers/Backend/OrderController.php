<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDatails;
use Auth;


class OrderController extends Controller
{
    public $p_user;

    // for order permission auth
         public function __construct() {
            $this->middleware(function($request, $next){
                $this->p_user =Auth::user();
                return $next($request);
    
            }) ;
        }
    public function index(){
        if (is_null($this->p_user) || !$this->p_user->can('order.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any order !');
        }
        

        $orderData = Order::orderBy('id', 'DESC')->get();

        return view('backend.order.orderManage', compact('orderData'));
    }
    function orderFullDetails($id){
        if (is_null($this->p_user) || !$this->p_user->can('order.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any order !');
        }
        $order = Order::where('id',$id)->first();
        $orderId= OrderDatails::where('order_id',$id)->get();
        return view('backend.order.orderFullDetails', compact('order','orderId'));
    }
    function orderFullDetailsDelete($id){
        if (is_null($this->p_user) || !$this->p_user->can('order.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any order !');
        }
        $order =Order::find($id);        
      
        $msg = $order->delete();
     
        if($msg){
            return redirect()->back()->with('success', 'Order Data delete successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Data not delete');

        }
    }
    function orderInvoice($id){
        if (is_null($this->p_user) || !$this->p_user->can('order.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any order !');
        }
        $order = Order::where('id',$id)->first();
        $orderId= OrderDatails::where('order_id',$id)->get();
        return view('backend.order.orderInvoice', compact('order','orderId'));

    }
    // order status
    function orderStatusUpdate( Request $request,$id){
        if (is_null($this->p_user) || !$this->p_user->can('order.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any order !');
        }
        $order = Order::where('id',$id)->first();
        $order->status = $request->status;
        $msg = $order->update();
     
        if($msg){
            return redirect()->back()->with('success', 'Order status Update successfully');

        }
        else{
            return redirect()->back()->with('error', 'opps! Order Status not Updated');

        }
    }

    
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDatails;


class OrderController extends Controller
{
    public function index(){
        $orderData = Order::orderBy('id', 'DESC')->get();

        return view('backend.order.orderManage', compact('orderData'));
    }
    function orderFullDetails($id){
        $order = Order::where('id',$id)->first();
        $orderId= OrderDatails::where('order_id',$id)->get();
        return view('backend.order.orderFullDetails', compact('order','orderId'));
    }
    function orderFullDetailsDelete($id){
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
        $order = Order::where('id',$id)->first();
        $orderId= OrderDatails::where('order_id',$id)->get();
        return view('backend.order.orderInvoice', compact('order','orderId'));

    }
    // order status
    function orderStatusUpdate( Request $request,$id){
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

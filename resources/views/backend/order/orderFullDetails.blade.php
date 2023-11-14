@extends('backend.master')

@section('maincontent')

<div class="container">
    <div class="row" >

        <div class="col-md-12">
            <div class="text-right" >
                <a class="btn btn-lg btn-info" href="{{route('order.order.invoice',$order->id)}}"  >Invoice</a>
            </div>
        </div>

    </div>

    <br>
    <div class="row">
        <div class="col-md-4 box span6">
            <div class="box-header">
                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
                
            </div>
            
            <div class="box-content">
                <table class="table ">
                    <thead>
                    <tr class="table-primary">
                        <th>Customer Name</th>
                        <th>Customer Email</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-success">
                        <td>{{$order->customer->name}}</td>
                        <td class="center">{{$order->customer->email}}</td>


                    </tr>


                    </tbody>
                </table>

            </div>
        </div><!--/span-->



        <div class="col-md-1"></div>
        <div class="col-md-7 span6">
            <div class="box-header">
                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping Details</h2>
                
            </div>
            <div class="box-content">
                <table class="table table-success table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Shipping Address</th>
                        <th>Mobile No</th>
                        <th>Email Address</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{$order->shipping->name}}</td>
                        <td class="center">{{$order->shipping->address}}</td>
                        <td class="center">{{$order->shipping->phone}}</td>
                        <td class="center">{{$order->shipping->email}}</td>
                        <td class="center">{{$order->payment->paymentMethod}}</td>
                        <td class="center">{{$order->status}}</td>

                    </tr>



                    </tbody>
                </table>


            </div>
        </div>

    </div><!--/row-->
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="box-header">
            <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Order Details</h2>
            
        </div>
        <div class="box-content">
            <table class="table table-success table-striped" >
                <thead >
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Product price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($orderId as $orderdata)
                    <tr class="table-primary">
                        <td>{{$orderdata->order_id}}</td>
                        <td class="center">{{$orderdata->product_name}}</td>
                        <td class="center">{{$orderdata->product->p_code}}</td>
                        <td class="center">{{($orderdata->product_color != null) ?$orderdata->product_color : 'None'}}</td>
                        <td class="center">{{($orderdata->product_size != null) ?$orderdata->product_size : 'None'}}</td>
                        <td class="center">&#2547; {{$orderdata->product_price}}</td>
                        <td class="center">{{$orderdata->product_sale_qty}}</td>
                        <td class="center"> &#2547; {{$orderdata->product_price * $orderdata->product_sale_qty}}</td>
                    </tr>
                    @endforeach
                
                </tbody>
    
                <tfoot>
                <tr class="table-dark">
                    <td colspan="7" style="font-size: 20px;font-weight: 521;text-align: right; color: rgb(53, 52, 52)">Shipping charge</td>
                    <td><strong style="font-size: 20px; color: #007cff;">&#2547;100 </strong></td>
                </tr>
                <tr class="table-dark">
                    <td colspan="7" style="font-size: 18px;font-weight: 521;text-align: right; color: red"> Total Amount to pay</td>
                    <td><strong style="font-size: 20px; color: #007cff;">&#2547; {{$order->total}} </strong></td>
                </tr>
                </tfoot>
            </table>
    
    
        </div>
    </div>
</div>
</div>
@endsection
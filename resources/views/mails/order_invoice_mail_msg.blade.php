@component('mail::message');
<?php
use App\Models\IncludeAnother;
use App\Models\Order;
use App\Models\OrderDatails;

    $shipping_charge =IncludeAnother::findOrFail(1);
    $order= Order::findOrFail($orderId);
    $orderIds= OrderDatails::where('order_id',$orderId)->get();


?>
<h4 class="display-3">Order Id-{{$order->id}} </h4>
<p>Hello {{$user_id->name}} </p>
<hr>
<hr>
<div class="" style="display: flex; align-content:space-between;">
    <p>
        <strong>Billed To:</strong><br>
        {{$order->customer->name}}<br>
    
    </p>
    <p >
        <strong>Shipped To:</strong><br>
        Name: {{$order->shipping->name}}<br>
        Email: {{$order->shipping->email}}<br>
        Phone: {{$order->shipping->phone}} <br>
        Address: {{$order->shipping->address}}<br>
        {{$order->shipping->city}},{{$order->shipping->country}}
            
    </p>
</div>
<hr>
<div class="" style="display: flex; align-content: space-between">
    <address>
        <strong>Payment Method:</strong><br>
        {{$order->payment->paymentMethod}}<br>
        {{$order->shipping->email}}
      </address>
      <address>
        <strong>Order Date:</strong><br>
        {{ $order->created_at->format('M d,y-  h:iA') }}<br><br>
      </address>
</div>
<hr>
<p class="section-title">Order Summary</p>
<table class="table table-striped table-hover table-md">
    <tbody>
      <tr>
          <th data-width="40" style="width: 40px;">#</th>
          <th>Product Name</th>
          <th class="text-center">Color</th>
          <th class="text-center">Size</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-right">Totals</th>
      </tr>
      @php
      $sl =1;
      @endphp
      @foreach($orderIds as $data)
      <tr>
          <td>{{$sl++}}</td>
          <td>{{$data->product_name}}</td>
          <td class="text-center">{{($data->product_color != null) ?$data->product_color : 'None'}}</td>
          <td class="text-center">{{($data->product_size != null) ?$data->product_size : 'None'}}</td>
          <td class="text-center">&#2547; {{$data->product_price}}</td>
          <td class="text-center">{{$data->product_sale_qty}}</td>
          <td class="text-right"> &#2547; {{$data->product_price * $data->product_sale_qty}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>

  <hr>
  <p class="invoice-detail-item " style="float: right">
    @php
    $delivery = $shipping_charge ->shipping_charge_insite;
    @endphp
    <span class="invoice-detail-name">Subtotal</span>
    <span class="invoice-detail-value">&#2547; {{$order->total -$delivery}}</span>
  </p>
  <hr class="clearfix">
  <p class="invoice-detail-item " style="float: right">
    <span class="invoice-detail-name ">Shipping</span>
    <span class="invoice-detail-value">&#2547; {{$delivery}}</span>
  </p>
  <hr class="mt-2 mb-2 clearfix">
  <p class="invoice-detail-item " style="float: right">
    <span class="invoice-detail-name">Total</span>
    <span class="invoice-detail-value invoice-detail-value-lg">&#2547;{{$order->total}}</span>
  </p>
  <p class="clearfix"></p>


Thanks <br>
{{config('app.name')}}

@endcomponent
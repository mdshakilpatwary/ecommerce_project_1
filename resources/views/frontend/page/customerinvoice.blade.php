

@extends('frontend.master')

@section('mainbody')


		<!-- SECTION -->
		<div class="section">
			<!-- container -->


            <div class="container" >
                <div class="invoice" >
                    <div class="invoice-print" id="content_invoice" >
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Order Id-{{$order->order_invoice_id}} </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-6">
                              <address>
                                <strong>Billed To:</strong><br>
                                {{$order->customer->name}}<br>
                                6404 Cut Glass Ct,<br>
                                Wendell,<br>
                                NC, 27591, USA
                              </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                              <address>
                                <strong>Shipped To:</strong><br>
                            Name: {{$order->shipping->name}}<br>
                            Email: {{$order->shipping->email}}<br>
                            Phone: {{$order->shipping->phone}} <br>
                             Address: {{$order->shipping->address}}<br>
                                {{$order->shipping->city}},{{$order->shipping->country}}<br>
                                
                              </address>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <address>
                                <strong>Payment Method:</strong><br>
                                {{$order->payment->paymentMethod}}<br>
                                {{$order->shipping->email}}
                              </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                              <address>
                                <strong>Order Date:</strong><br>
                                {{$order->created_at->format('M d,y-  h:iA')}}<br><br>
                              </address>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-md-12">
                          <div class="section-title">Order Summary</div>
                          <p class="section-lead">All items here cannot be deleted.</p>
                          <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                              <tbody><tr>
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
                              @foreach($orderId as $data)
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
                        
                            </tbody></table>
                          </div>
                          <div class="row mt-4">
                            <div class="col-lg-8">
                              <div class="section-title">Payment Method</div>
                              <p class="section-lead">The payment method that we provide is to make it easier for you to pay
                                invoices.</p>
                              <div class="images">
                                <img src="assets/img/cards/visa.png" alt="visa">
                                <img src="assets/img/cards/jcb.png" alt="jcb">
                                <img src="assets/img/cards/mastercard.png" alt="mastercard">
                                <img src="assets/img/cards/paypal.png" alt="paypal">
                              </div>
                            </div>
                            <div class="col-lg-4 text-right">
                              <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">&#2547; {{$order->total - $order->delivery_charge}}</div>
                              </div>
                              <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Shipping</div>
                                @if($order->delivery_charge == 0)
                                <div class="invoice-detail-value">Free</div>
                                @else
                                <div class="invoice-detail-value">&#2547; {{$order->delivery_charge}}</div>
                                @endif                              </div>
                              <hr class="mt-2 mb-2">
                              <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">&#2547;{{$order->total}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                      <div class="float-lg-left mb-lg-0 mb-3">
                        
                      </div>
                      <button onclick="printContent()" class="btn btn-warning btn-icon icon-left"><i class="fa fa-print"></i> Print</button>
                    </div>
                  </div>
            </div>

            
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection

<script>
    function printContent() {
        // Open a new window with only the content to be printed
        var printWindow = window.open('', '_blank');
        
        // Get the HTML content to be printed
        var contentToPrint = document.getElementById('content_invoice').outerHTML;
  
        // Write the content to the new window
        printWindow.document.write('<html><head><title>Print Content</title><link rel="stylesheet" type="text/css" href="print.css" media="print"></head><body>' + contentToPrint + '</body></html>');
  
        // Close the document stream
        printWindow.document.close();
  
        // Trigger the print dialog
        printWindow.print();
    }
</script>
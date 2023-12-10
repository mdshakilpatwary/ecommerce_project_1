<?php
use App\Models\IncludeAnother;

$shipping_charge =IncludeAnother::findOrFail(1);
?>
@extends('frontend.master')

@section('mainbody')
@if(Session::get('access_page')=='okay')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{route('frontend_site')}}">Home</a></li>
                    <li class="">Shipping Details</li>
                    <li class="active">Payment </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
            <div class="row">
                <div class="col-md-3"></div>
            <div class="col-md-6  order-details order-details-p">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                    
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products">
                        @foreach($cartArray as $productItem)
                        <div class="order-col">
                            <div>{{$productItem['qty']}}x {{$productItem['name']}}</div>
                            <div>&#2547;{{$productItem['price']*$productItem['qty']}}</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="order-col">
                        <div>Shiping</div>
                        @php 
							$shippingcost = $shipping_charge ->shipping_charge_insite;
						@endphp
                        <div><strong>{{$shippingcost}}</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total">&#2547;{{cart::subtotal()+$shippingcost}}</strong></div>
                    </div>
                </div>
                <div class="selection_title ">
                    <h4 class="text-center title" style="color: #d10024; padding: 10px 0; ">Please select your payment method</h4>
                </div>
            <form action="{{route('product.placeOrder')}}" method="POST">
                    @csrf
                <div class="payment-method">
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-1" value="cash">
                        <label for="payment-1">
                            <span></span>
                            Cash on delivery
                        </label>
                        <div class="caption">
                            <p>You can aslo select cash on delivery method</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-2" value="bkash">
                        <label for="payment-2">
                            <span></span>
                            Bkash
                        </label>
                        <div class="caption">
                            <p>Bkash No: 01585556654</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-3" value="nagod">
                        <label for="payment-3">
                            <span></span>
                            Nagod
                        </label>
                        <div class="caption">
                            <p>Nagod No: 01858545615</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-4" value="roket">
                        <label for="payment-4">
                            <span></span>
                            Roket
                        </label>
                        <div class="caption">
                            <p>Roket No: 01858545615</p>
                        </div>
                    </div>
                    @error('payment')
								<p class="text-danger pt-1">{{$message}}</p>
					@enderror
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" id="terms" name="tarms_checbox">
                    <label for="terms">
                        <span></span>
                        I've read and accept the <a href="#">terms & conditions</a>
                    </label>
                    @error('tarms_checbox')
                    <p class="text-danger pt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="submit-button text-center">
                    <button class="primary-btn order-submit ">Place order</button>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
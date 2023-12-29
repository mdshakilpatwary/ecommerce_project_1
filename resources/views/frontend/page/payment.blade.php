<?php
use App\Models\IncludeAnother;
use App\Models\ShippingDetails;
?>
@extends('frontend.master')

@section('mainbody')
@if(Session::get('access_page')=='access'.Auth::user()->id)
@php


$shipping_charge =IncludeAnother::findOrFail(1);
$shipping_chargeType =ShippingDetails::findOrFail(Session::get('sid'));

@endphp
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
                        <!-- shipping charge  -->
                        @php 
                            if($shipping_chargeType->shipping_charge_type == 'inside-dhaka'){
                                $shippingcost = $shipping_charge ->shipping_charge_insite;}
                            else if($shipping_chargeType->shipping_charge_type == 'outside-dhaka'){
                                $shippingcost = $shipping_charge ->shipping_charge_outsite;
                            }

						@endphp
                        @if($shippingcost == null || $shippingcost == 0)
                        <div><strong>Free</strong></div>

                        @else
                        <div><strong>{{$shippingcost}}</strong></div>
                        @endif
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        @if($shippingcost == null || $shippingcost == 0)
                        <div><strong class="order-total">&#2547;{{ceil(cart::subtotal())}}</strong></div>
                        @else
                        <div><strong class="order-total">&#2547;{{ceil(cart::subtotal()+$shippingcost)}}</strong></div>
                        @endif
                    </div>
                </div>
                <div class="selection_title ">
                    <h4 class="text-center title" style="color: #d10024; padding: 10px 0; ">Please select your payment method</h4>
                </div>
                @php
                    if($shippingcost == null || $shippingcost == 0){
                        $delivery_charge = 0;
                    }
                    else {
                        $delivery_charge = $shippingcost;
                    }

                @endphp
            <form action="{{route('product.placeOrder')}}" method="POST">
                    @csrf
                    <input type="hidden" name="delivery_charge" value="{{$delivery_charge}}">
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
@else
<script type="text/javascript">
    // Hide the template after a few seconds
    setTimeout(function () {

        window.location.href = '/'; 
    }, 200); 
</script>
@endif

@endsection
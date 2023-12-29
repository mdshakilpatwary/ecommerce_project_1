<?php
use App\Models\IncludeAnother;
$cartArray =cartArray();
$shipping_charge =IncludeAnother::findOrFail(1);
?>

@extends('frontend.master')

@section('mainbody')
<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
@if(count($cartArray)!=0)
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
				<form action="{{route('product.shipping.details')}}" method="POST">
					@csrf
					<div class="col-md-7">
						<!-- Shipping Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>

							<div class="form-group">
								<label for="">Name</label>
								<input class="input" type="text" name="name" placeholder="Full Name" value="{{old('name')}}">
								@error('name')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>

							<div class="form-group">
								<label for="">Email</label>
								<input class="input" type="email" name="email" placeholder="Email" value="{{old('email')}}">
								@error('email')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Phone</label>
								<input class="input" type="tel" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
								@error('phone')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Address</label>
								<input class="input" type="text" name="address" placeholder="Address" value="{{old('address')}}">
								@error('address')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="">City</label>
								<input class="input" type="text" name="city" placeholder="City" value="{{old('city')}}">
								@error('city')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Country</label>
								<input class="input" type="text" name="country" placeholder="Country" value="{{old('country')}}">
								@error('country')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<label for="">Zip Code</label>
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code" value="{{old('zip_code')}}">
							</div>
							<div class=" form-group order-notes">
								<label for="">Description</label>
								<textarea class="input" name="description" placeholder="Order Notes">{{old('description')}}</textarea>
							</div>
							<div class=" form-group text-right">
								<button class="btn btn-info btn-lg ">Next and make payment</button>
							</div>
						
						</div>
						<!-- /shipping Details -->




					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
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
									<div>&#2547;{{$productItem['price'] * $productItem['qty']}}</div>
								</div>
								@endforeach
							</div>
							
							<hr>
							<p>Select Shiping Charge</p>
							<div class="order-col">
								<div>
									<div style="margin-bottom: 10px;">
										<input type="radio" name="shipping_charge_type" id="inside-dhaka" value="inside-dhaka">
										<label for="inside-dhaka">Inside Dhaka City</label>
	
									</div>
									<div >
										<input type="radio" name="shipping_charge_type" id="outside-dhaka" value="outside-dhaka">
										<label for="outside-dhaka">Outside Dhaka City</label>
	
									</div>
									
								</div>
								<div>
									<div style="margin-bottom: 10px;" ><strong>
										@if($shipping_charge ->shipping_charge_insite != null or 0)
										&#2547;{{$shipping_charge ->shipping_charge_insite}}
										@else
										Free
										@endif
									</strong></div>
									<div ><strong>
										@if($shipping_charge ->shipping_charge_outsite !=null or 0)
										&#2547;{{$shipping_charge ->shipping_charge_outsite}}
										@else
										Free
										@endif
										
									</strong></div>

								</div>
								
							</div>
							<div class="order-col">	
								@error('shipping_charge_type')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<hr>
							<div class="order-col">	
								<div>Shiping Charge</div>
								<div id="shipping_charge">Unselect</div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">&#2547;<span id="checkout-page-order-total">{{ceil(cart::subtotal())}}</span></strong></div>
							</div>
						</div>

					</div>
				</form>

					<!-- /Order Details -->
				</div>
				<!-- /row -->
@else
<h4 class="text-danger text-center">Please Add your product on Cart-box <a href="{{route('frontend_site')}}">Click here</a></h4>
@endif
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection

@section('customeJavascripti')

<script>
	$(document).ready(function(){
		$("#inside-dhaka").prop( "checked", false ) ;
		$("#outside-dhaka").prop( "checked", false ) ;


	$('#inside-dhaka, #outside-dhaka').click(function(){
		if ($('#inside-dhaka').prop('checked') == true) {
			$.ajax({
				url: "{{url('/select/shipping/charge')}}",
                type: 'get',
                success: function(response_s) {
					if(response_s.inside_dhaka ==null || response_s.inside_dhaka == 0){
					$('#shipping_charge').html('<strong>Free</strong>');
					}else{
						$('#shipping_charge').html('<strong>&#2547;'+response_s.inside_dhaka +'</strong>');
					}
					$('#checkout-page-order-total').text(response_s.cart_total + response_s.inside_dhaka);

					
				}
			});
		} 
		else if ($('#outside-dhaka').prop('checked') == true) {
			$.ajax({
				url: "{{url('/select/shipping/charge')}}",
                type: 'get',
                success: function(response_s) {
					if(response_s.outside_dhaka == null || response_s.outside_dhaka == 0){
					$('#shipping_charge').html('<strong>Free</strong>');
					}else{
						$('#shipping_charge').html('<strong>&#2547;'+response_s.outside_dhaka +'</strong>');

					}
					$('#checkout-page-order-total').text(response_s.cart_total + response_s.outside_dhaka);

					
				}
			});
		}
	});

});
</script>
@endsection





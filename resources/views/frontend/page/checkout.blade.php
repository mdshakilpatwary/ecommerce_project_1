@php
$cartArray =cartArray();
@endphp	

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

					<div class="col-md-7">
						<!-- Shipping Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<form action="{{route('product.shipping.details')}}" method="POST">
								@csrf
							<div class="form-group">
								<input class="input" type="text" name="name" placeholder="Full Name">
								@error('name')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>

							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
								@error('email')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
								@error('address')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
								@error('city')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
								@error('country')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Phone Number">
								@error('phone')
								<p class="text-danger pt-1">{{$message}}</p>
								@enderror
							</div>
							<div class=" form-group order-notes">
								<textarea class="input" name="description" placeholder="Order Notes"></textarea>
							</div>
							<div class=" form-group text-right">
								<button class="btn btn-info btn-lg ">Next</button>
							</div>
						</form>
						
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
							<div class="order-col">
								@php 
								$shippingcost = 100;
								@endphp
								<div>Shiping Charge</div>
								<div><strong>&#2547;{{$shippingcost}}</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">&#2547;{{cart::subtotal()+$shippingcost}}</strong></div>
							</div>
						</div>

					</div>
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
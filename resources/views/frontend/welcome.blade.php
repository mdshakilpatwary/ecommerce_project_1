<?php
use Carbon\Carbon;
?>
@extends('frontend.master')

@section('mainbody')
			<!-- SECTION -->
			<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					
					@foreach ($categories as $category)
					@if ($loop->iteration <= 3)
					<!-- shop -->
					<div class="col-md-4 col-xl-4 col-lg-4">
						<div class="shop w-100">
							<div class="shop-img ">
								<img class="w-100" src="{{asset('uploads/category/'.$category->cat_image)}}"  height="200" alt="">
							</div>
							<div class="shop-body">
								<h3>{{$category->cat_name}}<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
					@endif
					@endforeach


					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									@foreach($categories as $category)
									<li class=""><a  href="{{route('show.category.product',$category->id)}}">{{$category->cat_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										@foreach($products as $product)
										<!-- product -->
										<div class="product">
											<a href="{{route('single.product',$product->id)}}">
											<div class="product-img">
												<img src="{{asset('uploads/product/'.$product->p_image)}}"  height="250" alt="">
												<div class="product-label">
													@if($product->discount_percentage > 0)
													<span class="sale">{{$product->discount_percentage}}%</span>
													@endif
													@if (now()->diffInDays($product->created_at) < 3)
														<span class="new">NEW</span>
													@endif												</div>
											</div>
											
											<div class="product-body">
												
												<p class="product-category">{{$product->category->cat_name}}</p>
												<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{ Illuminate\Support\Str::limit($product->p_name,50,'....')}}</a></h3>
												<h4 class="product-price" style="padding: 3px 0;">	&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))  }}<del class="product-old-price">	&#2547;{{$product->p_price}}</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												@php													
												@endphp
												<div class="product-btns">
													<form style="display: inline"  action="{{route('product.add_to_wishlist')}}" method="POST">
													@csrf
														<input type="hidden" name="product_id" value="{{$product->id}}">
														@if(Auth::user())
														<!-- cart wishlist  -->
															@if(App\Models\CartWishlist::where('p_id',$product->id)->where('user_id', Auth::user()->id)->first())
															<button disabled  class="add-to-wishlist" style="background: none; border:none;"><i style="color:red;" class="fa fa-heart"></i><span class="tooltipp">add to wishlist</span></button>
		
															@else
															<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
															@endif
														@else
														<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
														@endif													
													</form>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view" value="{{$product->id}}" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
												
											</div>
											</a>
											<form action="{{route('product.add_to_cart')}}" method="POST">
												@csrf
											<div class="add-to-cart">
												<input type="hidden" name="quantity" value="1">
												<input type="hidden" name="product_id" value="{{$product->id}}">
												@if($product->p_qty != 0)
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
												@else
												<span class="product-available " style="color:white;">Stock Out</span>
												@endif
											</div>
											</form>
										</div>
										<!-- /product -->
										@endforeach
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section " >
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
			<!-- Offer content  condition -->
					@if(count($offerData) > 0)

						@php
							$offerDealData =App\Models\OfferDealContent::findOrFail(1);
							$currentDateTime = Carbon::now();
							$startDate = $offerDealData->offer_duration_start;
							$endDate =$offerDealData->offer_duration_end;
						@endphp
						<div class="col-md-2 col-lg-3 col-xl-3 d-sm-none offer_deal_image1">
							<img src="{{asset('uploads/offer_banner/'.$offerDealData->image1)}}" alt="">
						</div>
						<div class="col-md-8 col-lg-6 col-xl-6 col-12 col-sm-12">
							<div class="hot-deal">
					<!-- Offer time counter code condition -->

								@if ($currentDateTime->between($startDate, $endDate)) 
									<ul class="hot-deal-countdown">
										<li>
											<div>
												<h3 id="offer_deal_day"></h3>
												<span>Days</span>
											</div>
										</li>
										<li>
											<div>
												<h3 id="offer_deal_hour"></h3>
												<span>Hours</span>
											</div>
										</li>
										<li>
											<div>
												<h3 id="offer_deal_minute"></h3>
												<span>Mins</span>
											</div>
										</li>
										<li>
											<div>
												<h3 id="offer_deal_second"></h3>
												<span>Secs</span>
											</div>
										</li>
									</ul>
								@else
									<ul class="hot-deal-countdown">
										<li>
											<div>
												<h3 >0</h3>
												<span>Days</span>
											</div>
										</li>
										<li>
											<div>
												<h3 >0</h3>
												<span>Hours</span>
											</div>
										</li>
										<li>
											<div>
												<h3 >0</h3>
												<span>Mins</span>
											</div>
										</li>
										<li>
											<div>
												<h3 >0</h3>
												<span>Secs</span>
											</div>
										</li>
									</ul>
								@endif
								<h2 class="text-uppercase">{{$offerDealData->offer_heading}}</h2>
								<p>{{$offerDealData->offer_content}}</p>
								<a class="primary-btn cta-btn" href="{{route('show.all.product')}}">Shop now</a>
							</div>
						</div>
						<div class="col-md-2 col-lg-3 col-xl-3 d-sm-none offer_deal_image2">
							<img src="{{asset('uploads/offer_banner/'.$offerDealData->image2)}}" alt="">
						</div>
					@else
						<div class="col-md-2 col-lg-3 col-xl-3 d-sm-none offer_deal_image1">
							<img src="{{asset('frontend/assets')}}/img/product01.png" alt="">
						</div>
						<div class="col-md-8 col-lg-6 col-xl-6 col-12 col-sm-12">
							<div class="hot-deal">
								<ul class="hot-deal-countdown">
									<li>
										<div>
											<h3 >0</h3>
											<span>Days</span>
										</div>
									</li>
									<li>
										<div>
											<h3 >0</h3>
											<span>Hours</span>
										</div>
									</li>
									<li>
										<div>
											<h3 >0</h3>
											<span>Mins</span>
										</div>
									</li>
									<li>
										<div>
											<h3 >0</h3>
											<span>Secs</span>
										</div>
									</li>
								</ul>
								<h2 class="text-uppercase">hot deal this week</h2>
								<p>New Collection Up to 50% OFF;</p>
								<a class="primary-btn cta-btn" href="{{route('show.all.product')}}">Shop now</a>
							</div>
						</div>
						<div class="col-md-2 col-lg-3 col-xl-3 d-sm-none offer_deal_image2">
							<img src="{{asset('frontend/assets')}}/img/product02.png" alt="">
						</div>
					@endif
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					{{-- <div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									@foreach($categories as $category)
									<li class="active"><a  href="{{route('show.category.product',$category->id)}}">{{$category->cat_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div> --}}
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										@foreach($topProducts as $product)
										<!-- product -->
										<div class="product">
											<a href="{{route('single.product',$product->id)}}">
											<div class="product-img">
												<img src="{{asset('uploads/product/'.$product->p_image)}}" height="250" alt="">
												<div class="product-label">
													@if($product->discount_percentage > 0)
													<span class="sale">{{$product->discount_percentage}}%</span>
													@endif
													@if (now()->diffInDays($product->created_at) < 3)
														<span class="new">NEW</span>
													@endif
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{$product->category->cat_name}}</p>
												<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{ Illuminate\Support\Str::limit($product->p_name,50,'....')}}</a></h3>
												<h4 class="product-price" style="padding: 5px 0;">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<form style="display: inline"  action="{{route('product.add_to_wishlist')}}" method="POST">
														@csrf
															<input type="hidden" name="product_id" value="{{$product->id}}">
															@if(Auth::user())
															<!-- cart wishlist -->
																@if(App\Models\CartWishlist::where('p_id',$product->id)->where('user_id', Auth::user()->id)->first())
																<button disabled  class="add-to-wishlist" style="background: none; border:none;"><i style="color:red;" class="fa fa-heart"></i><span class="tooltipp">add to wishlist</span></button>
			
																@else
																<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
																@endif
															@else
															<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
															@endif												</form>													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
															<button class="quick-view" value="{{$product->id}}" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
														</div>
											</div>
										</a>
										<form action="{{route('product.add_to_cart')}}" method="POST">
											@csrf
										<div class="add-to-cart">
											<input type="hidden" name="quantity" value="1">
											<input type="hidden" name="product_id" value="{{$product->id}}">
											@if($product->p_qty != 0)
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
											@else
											<span class="product-available " style="color:white;">Stock Out</span>
											@endif										</div>
										</form>
										</div>
										<!-- /product -->
										@endforeach
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
								<!-- product widget -->
								@foreach($topProducts as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->


							</div>

							<div>
								<!-- product widget -->
								@foreach($topProducts as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->

	
	
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title"> selling</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								@foreach($topProducts as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->


							</div>

							<div>
								<!-- product widget -->
								@foreach($topProducts as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->

	
	
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Top selling</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								@foreach($topProducts as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->


							</div>

							<div>
								<!-- product widget -->
								@foreach($products as $product)
								@if ($loop->iteration <= 3)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{$product->category->cat_name}}</p>
										<h3 class="product-name"><a href="{{route('single.product',$product->id)}}">{{$product->p_name}}</a></h3>
										<h4 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h4>
									</div>
								</div>
								@endif
								@endforeach
								<!-- /product widget -->

	
	
							</div>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->



@endsection
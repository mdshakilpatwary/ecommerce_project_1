<?php
use App\Models\ProductReview;
?>
@extends('frontend.master')

@section('mainbody')
	<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<input type="hidden" id="single_product_id" value="{{$product->id}}">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">{{$product->category->cat_name}}</a></li>
                    <li><a href="#">{{$product->subcategory->subcat_name}}</a></li>
                    <li class="active">{{$product->p_name}}</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<!-- multiple img show  -->
							
							
							
							 @foreach(explode('|',$product->group_p_image) as $group_image)
							<div class="product-preview">
								<img src="{{asset('uploads/product/product_group/'.$group_image)}}" alt="">
							</div>
							@endforeach

							
							
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							@foreach(explode('|',$product->group_p_image) as $group_image)
							<div class="product-preview">
								<img src="{{asset('uploads/product/product_group/'.$group_image)}}" alt="">
							</div>
							@endforeach

						
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{$product->p_name}}</h2>
							<div>
								@if($product->discount_percentage > 0)
									<span class="bg-success">Discount {{$product->discount_percentage}}%</span>
								@else
								<span class="bg-warning ">No Discount</span>
								@endif
								<br class="mb-3">
								@if (now()->diffInDays($product->created_at) < 3)
								<span class="new">NEW</span>
								@endif	
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<span id="review_count_top" style="font-weight: 600; color:gray"></span>
								</div>
							</div>
							<div>
								<h3 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h3>
								@if($product->p_qty != 0)
								<span class="product-available">In Stock</span>
								@endif
							</div>
							<p>{{$product->short_description}}</p>
							<form action="{{route('product.add_to_cart')}}" method="POST">
								@csrf

							<div class="product-options">
								<label>
									@if($product->size_id != null)
									Size
									@else
									Kg/Liter
									@endif
									<select class="input-select" name="size">
										@if($product->size_id != null)
										@foreach(explode("|",$product->size_id) as $size)										
										<option value="{{$size}}">{{$size}}</option>
										@endforeach
										@else
										@foreach(explode("|",$product->kg_liter) as $kg)										
										<option value="{{$kg}}">{{$kg}}</option>
										@endforeach
										@endif
									</select>
								</label>
								<label>
									Color

									<select class="input-select" name="color">
										@foreach(explode("|",$product->color_id) as $color)
										<option value="{{$color}}">{{$color}}</option>
										@endforeach
									</select>
								</label>
							</div>
							@if($product->p_qty != 0)
							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" name="quantity" value="1" >
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
									@error('quantity')
									<p class="text-danger pt-1">{{$message}}</p>
									@enderror
								</div>
								<input type="hidden" name="product_id" value="{{$product->id}}">

								<button  class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
								
							</div>
							@else
							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" name="quantity" class="quantity" value="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
									@error('quantity')
									<p class="text-danger pt-1">{{$message}}</p>
									@enderror
								</div>
								<input type="hidden" name="product_id" value="{{$product->id}}">

								<button disabled class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Stock Out</button>
								
							</div>
							@endif
							</form>

							<ul class="product-btns">
								<form style="display: inline"  action="{{route('product.add_to_wishlist')}}" method="POST">
									@csrf
										<input type="hidden" name="product_id" value="{{$product->id}}">
									@if(Auth::user())
									{{-- wishlist --}}
										@if(App\Models\CartWishlist::where('p_id',$product->id)->where('user_id', Auth::user()->id)->first())
										<li><a ><button  disabled style="background: none; border:none;"><i class="fa fa-heart"></i> ADD TO WISHLIST</button></a></li>

										@else
										<li><a ><button style="background: none; border:none;"><i class="fa fa-heart-o"></i> ADD TO WISHLIST</button></a></li>
										@endif
									@else
									<li><a ><button style="background: none; border:none;"><i class="fa fa-heart-o"></i> ADD TO WISHLIST</button></a></li>

									@endif
									</form>
								{{-- <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li> --}}
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">{{$product->category->cat_name}}</a></li>
								<li><a href="#">{{$product->subcategory->subcat_name}}</a></li>
							</ul>

							{{-- <ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul> --}}

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews <span id="review_count"></span></a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>{!!$product->p_description!!}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											@if($product->p_details == '')
											<p class="text-center">No details here</p>
											@else
											<p>{{$product->p_details}}</p>
											@endif
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											@if(count($review_product_data) > 0)
											@php
											$review_star_count_1 = ProductReview::where('product_id',$product->id)->where('rating', 1)->get();
											$review_star_count_2 = ProductReview::where('product_id',$product->id)->where('rating', 2)->get();
											$review_star_count_3 = ProductReview::where('product_id',$product->id)->where('rating', 3)->get();
											$review_star_count_4 = ProductReview::where('product_id',$product->id)->where('rating', 4)->get();
											$review_star_count_5 = ProductReview::where('product_id',$product->id)->where('rating', 5)->get();
											@endphp
												<div id="rating">
													<div class="rating-avg">														
														<span>{{$rating_round}}</span>
														@if($rating_round == 5)
															<div class="rating-stars">

																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
															</div>
														@elseif($rating_round == 4 or $rating_round == 4.5)
															<div class="rating-stars">

																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
															</div>
														@elseif($rating_round == 3 or $rating_round == 3.5)
															<div class="rating-stars">

																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
														@elseif($rating_round == 2 or $rating_round == 2.5)
															<div class="rating-stars">

																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
														@elseif($rating_round == 1 or $rating_round == 1.5)
															<div class="rating-stars">

																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
														@endif
													</div>
													<ul class="rating">
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{count($review_star_count_5) > 0? '100%': '0%'}};"></div>
															</div>
															<span class="sum">{{count($review_star_count_5)}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{count($review_star_count_4) > 0? '80%': '0%'}};"></div>
															</div>
															<span class="sum">{{count($review_star_count_4)}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{count($review_star_count_3) > 0? '60%': '0%'}};"></div>
															</div>
															<span class="sum">{{count($review_star_count_3)}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{count($review_star_count_2) > 0? '40%': '0%'}};"></div>
															</div>
															<span class="sum">{{count($review_star_count_2)}}</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: {{count($review_star_count_1) > 0? '20%': '0%'}};"></div>
															</div>
															<span class="sum">{{count($review_star_count_1)}}</span>
														</li>
													</ul>
												</div>
											@else
												<div id="rating">
													<div class="rating-avg">
														<span>0</span>
														<div class="rating-stars">
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
													</div>
													<ul class="rating">
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
															</div>
															<div class="rating-progress">
																<div style="width:0%;"></div>
															</div>
															<span class="sum">0</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div style="width: 0%;"></div>
															</div>
															<span class="sum">0</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div></div>
															</div>
															<span class="sum">0</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div></div>
															</div>
															<span class="sum">0</span>
														</li>
														<li>
															<div class="rating-stars">
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
																<i class="fa fa-star-o"></i>
															</div>
															<div class="rating-progress">
																<div></div>
															</div>
															<span class="sum">0</span>
														</li>
													</ul>
												</div>
											@endif
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews" id="public_review_part">
												</ul>
							
												<ul class="reviews-pagination review_pagination">
													{{-- <li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li> --}}
												</ul>
									
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<p class="insert_success bg-success " style="margin-bottom: 8px;"></p>
												<div class="insert_error bg-danger " style="margin-bottom: 8px;"></div>
												<div class="review-form" id="reviewInsertForm" >
													
												@if(Auth::user())
													@if(App\Models\ProductReview::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first() != true)
													
													<input type="hidden" id="review_product_id" value="{{$product->id}}">
													<input class="input" type="text" id="review_name" placeholder="Your Name">
													@error('review_name')
														<p class="text-danger ">{{$message}}</p>
													@enderror
													<input class="input" type="email" id="review_email" placeholder="Your Email">
													@error('review_email')
														<p class="text-danger ">{{$message}}</p>
													@enderror
													<textarea class="input" id="review" placeholder="Your Review"></textarea>
													@error('review')
														<p class="text-danger ">{{$message}}</p>
													@enderror
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="review_rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="review_rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="review_rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="review_rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="review_rating" value="1" type="radio"><label for="star1"></label>
															@error('rating')
																<p class="text-danger ">{{$message}}</p>
															@enderror
														</div>
														
													</div>
													<button class="primary-btn" id="review_submit_btn" onclick="reviewInsert()">Submit</button>
													@else
													<p>Already your review done</p>
													@endif

												@else
													<input class="input" type="text" id="review_name" placeholder="Your Name">
				
													<input class="input" type="email" id="review_email" placeholder="Your Email">
													<textarea class="input" id="review" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="review_rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="review_rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="review_rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="review_rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="review_rating" value="1" type="radio"><label for="star1"></label>
														</div>
														
													</div>
													<a href="{{route('login')}}" class="primary-btn" >Submit</a>
												@endif
												</div>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>


					<!-- product -->
					@foreach($related_product as $r_product)
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<a href="{{route('single.product',$r_product->id)}}">
							<div class="product-img">
								<img src="{{asset('uploads/product/'.$r_product->p_image)}}" alt="" height="250">
								<div class="product-label">
									@if($r_product->discount_percentage > 0)
									<span class="sale">{{$r_product->discount_percentage}}%</span>
									@endif
									<!-- <span class="new">NEW</span> -->								</div>
							</div>
							<div class="product-body">
								<p class="product-category">{{$r_product->category->cat_name}}</p>
								<h3 class="product-name  " ><a href="{{route('single.product',$r_product->id)}}">{{ Illuminate\Support\Str::limit($r_product->p_name,50,'....')}}</a></h3>
								<h4 class="product-price" style="padding: 5px 0;">&#2547;{{$r_product->p_price -($r_product->p_price*($r_product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$r_product->p_price}}</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<form style="display: inline"  action="{{route('product.add_to_wishlist')}}" method="POST">
										@csrf
											<input type="hidden" name="product_id" value="{{$r_product->id}}">
											@if(Auth::user())

												{{-- wishlist   --}}

												@if(App\Models\CartWishlist::where('p_id',$r_product->id)->where('user_id', Auth::user()->id)->first())
												<button disabled  class="add-to-wishlist" style="background: none; border:none;"><i style="color:red;" class="fa fa-heart"></i><span class="tooltipp">add to wishlist</span></button>

												@else
												<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
												@endif
											@else
											<button  class="add-to-wishlist" style="background: none; border:none;"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											@endif												
										</form>											
										{{-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> --}}
										<button class="quick-view" value="{{$r_product->id}}" data-toggle="modal" data-target="#productModal"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
									</div>
							</div>
						</a>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					@endforeach
					<!-- /product -->

	

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->


@endsection




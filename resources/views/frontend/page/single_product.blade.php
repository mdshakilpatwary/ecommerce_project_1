@extends('frontend.master')

@section('mainbody')
	<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
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
								<span class="bg-warning">No Discount</span>
								@endif
								<!-- <span class="new">NEW</span> -->
								{{-- <div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div> --}}
							</div>
							<div>
								<h3 class="product-price">&#2547;{{$product->p_price -($product->p_price*($product->discount_percentage/100))}} <del class="product-old-price">&#2547;{{$product->p_price}}</del></h3>
								@if($product->p_qty != 0)
								<span class="product-available">In Stock</span>
								@endif
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
										<input type="number" name="quantity" value="1">
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
										<input type="number" name="quantity">
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
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">{{$product->category->cat_name}}</a></li>
								<li><a href="#">{{$product->subcategory->subcat_name}}</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

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
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
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
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
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
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
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
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
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
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
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
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
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
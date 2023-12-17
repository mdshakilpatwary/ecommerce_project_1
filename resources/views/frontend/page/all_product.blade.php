
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
							<li class="active">All Product</li>
					
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
@if (count($products) > 0)
<div class="row">
	<!-- ASIDE -->
	<div id="aside" class="col-md-3">
		<!-- aside Widget -->
		<div class="aside">
			<h3 class="aside-title">Categories</h3>
			<div class="checkbox-filter">
				@foreach($categories as $category)
				@php
				$cat_count =App\Models\Product::catProductCount($category->id);	
				@endphp
				<div class="input-checkbox">
					<input type="checkbox" id="category-{{$category->id}}">
					<label for="category-{{$category->id}}">
						<span></span>
						<ul>
							<li><a href="{{route('show.category.product',$category->id)}}">{{$category->cat_name}}</a> <small>({{$cat_count}})</small></li>
						</ul>
						
					</label>
				</div>
				@endforeach
				
			</div>
		</div>
		<!-- /aside Widget -->

		<!-- aside Widget -->
		<!-- <div class="aside">
			<h3 class="aside-title">Price</h3>
			<div class="price-filter">
				<div id="price-slider"></div>
				<div class="input-number price-min">
					<input id="price-min" type="number">
					<span class="qty-up">+</span>
					<span class="qty-down">-</span>
				</div>
				<span>-</span>
				<div class="input-number price-max">
					<input id="price-max" type="number">
					<span class="qty-up">+</span>
					<span class="qty-down">-</span>
				</div>
			</div>
		</div> -->
		<!-- /aside Widget -->

		<!-- aside Widget -->
		<div class="aside">
			<h3 class="aside-title">Brand</h3>
			<div class="checkbox-filter">
				@foreach($brands as $brand)
				@php
				$brand_count =App\Models\Product::brandProductCount($brand->id);	
				@endphp
				<div class="input-checkbox">
					<input type="checkbox" {{ request()->is('show/brand/product/' . $brand->id) ? 'checked' : '' }} id="brand-{{$brand->id}}">
					<label for="brand-{{$brand->id}}">
						<span></span>
						<ul>
							<li><a href="{{route('show.brand.product',$brand->id)}}">{{$brand->brand_name}}</a> <small>({{$brand_count}})</small></li>

						</ul>
					</label>
				</div>
				@endforeach
			</div>
		</div>
		<!-- /aside Widget -->

		<!-- aside Widget -->
		<div class="aside">
			<h3 class="aside-title">Top selling</h3>
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
		</div>
		<!-- /aside Widget -->
	</div>
	<!-- /ASIDE -->

	<!-- STORE -->
	<div id="store" class="col-md-9">
		<!-- store top filter -->
		<!-- <div class="store-filter clearfix">
			<div class="store-sort">
				<label>
					Sort By:
					<select class="input-select">
						<option value="0">Popular</option>
						<option value="1">Position</option>
					</select>
				</label>

				<label>
					Show:
					<select class="input-select">
						<option value="0">20</option>
						<option value="1">50</option>
					</select>
				</label>
			</div>
			<ul class="store-grid">
				<li class="active"><i class="fa fa-th"></i></li>
				<li><a href="#"><i class="fa fa-th-list"></i></a></li>
			</ul>
		</div> -->
		<!-- /store top filter -->

		<!-- store products -->
		<div class="row">
			<!-- product -->
			@foreach($products as $product)
			<div class="col-md-4 col-xs-6">
				<div class="product">
					<a href="{{route('single.product',$product->id)}}">
					<div class="product-img">
						<img src="{{asset('uploads/product/'.$product->p_image)}}" alt="" height="250" >
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
						<p class="product-category" >{{$product->category->cat_name}}</p>
						<h3 class="product-name" ><a href="{{route('single.product',$product->id)}}">{{ Illuminate\Support\Str::limit($product->p_name,50,'....')}}</a></h3>
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

										{{-- wishlist   --}}

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
							<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
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
								@endif									</div>
					</form>
				</div>
			</div>
			<!-- /product -->
			@endforeach

		</div>
		<!-- /store products -->

		<!-- store bottom filter -->
		<div class="store-filter clearfix">
			<span class="store-qty">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} products</span>
			
			<div class="store-pagination">
				<div class="custom-pagination">
					<div class="pagination">
						{{-- Previous Page Link --}}
						@if ($products->onFirstPage())
							<span class="disabled">Previous</span>
						@else
							<a href="{{ $products->previousPageUrl() }}" rel="prev">Previous</a>
						@endif
				
						{{-- Pagination Elements --}}
						@for ($i = 1; $i <= $products->lastPage(); $i++)
							@if ($i == $products->currentPage())
								<span class="current">{{ $i }}</span>
							@else
								<a href="{{ $products->url($i) }}">{{ $i }}</a>
							@endif
						@endfor
				
						{{-- Next Page Link --}}
						@if ($products->hasMorePages())
							<a href="{{ $products->nextPageUrl() }}" rel="next">Next</a>
						@else
							<span class="disabled">Next</span>
						@endif
					</div>
				</div>

			</div>
		</div>
		<!-- /store bottom filter -->
	</div>
	<!-- /STORE -->
</div>
@else
<h4 class="text-center">No product here</h4>	
@endif
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection
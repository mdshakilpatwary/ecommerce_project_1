
	@if (count($products) > 0)
	<!-- /ASIDE -->

	<!-- STORE -->


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
							{{-- <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button> --}}
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
	
	<!-- /STORE -->
	@else
	<h4 class="text-center">Product not Found</h4>	
	@endif

@php
$cartArray =cartArray();
$wishlistArray = wishlistArray();
@endphp	
	<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +088{{$siteInfo->phone}}</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> {{$siteInfo->email}}</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> {{$siteInfo->address}}</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#">&#2547;</i>BDT</a></li>

						@if(Auth::user())
							@if(Auth::user()->role=='Admin')
							<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-user-o"></i> My Account</a></li>
							@else
							<li><a href="{{route('dashboard')}}"><i class="fa fa-user-o"></i> My Account</a></li>
						@endif

						<li><a href="{{route('user.logout')}}"><i class="fa fa-user-o"></i> Logout</a></li>
						@else
						<li><a href="{{route('login')}}"><i class="fa fa-user-o"></i> Login</a></li>
						<li><a href="{{route('register')}}"><i class="fa fa-user-o"></i> Register</a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->
		<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								@if($siteInfo->main_logo == '')
								<a href="/" class="logo" >
									<h3 style="color: white; font-size: 40px">{{$siteInfo->name}}</h3>
								</a>

								@else
								<a href="/" class="logo" style="">
									<img src="{{asset('uploads/info/'.$siteInfo->main_logo)}}" style="width: 120px; height: 70px" alt="">
								</a>
								@endif
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{route('product.search')}}" method="GET">
									@csrf
									<select class="input-select" name="category">
										<option value="All" {{request('category')== "All" ? 'selected' : ''}}>All Categories</option>
										@foreach ($categories as $category)
										<option value="{{ $category->id }} " {{request('category')== $category->id ? 'selected' : ''}}>{{ $category->cat_name }}</option>	
										@endforeach
									</select>
									<input class="input" placeholder="Search here" name="quearyProduct">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">{{count($wishlistArray)}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@foreach($wishlistArray as $cartdata)
											<div class="product-widget">
												<div class="product-img">
													@if(array_key_exists('p_image', $cartdata['options']))
													<img src="{{asset('uploads/product/'.$cartdata['options']['p_image'])}}"  alt="">   
													@endif
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="{{route('single.product',$cartdata['id'])}}">{{$cartdata['name']}}</a></h3>
													<h4 class="product-price"><span class="qty">{{$cartdata['qty']}}x</span>&#2547;{{$cartdata['price']}}</h4>
												</div>
												<a href="{{route('product.add_to_wishlist-delete',$cartdata['rowId'])}}" class="delete"><i class="fa fa-close"></i></a>
											</div>
											@endforeach
	
										</div>
										<div class="cart-btns">
											<h4 class="text-center">All Wishlist here</h4>
										</div>
									</div>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										
										<div class="qty">{{ count($cartArray)}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@foreach($cartArray as $cartdata)
											<div class="product-widget">
												<div class="product-img">
													@if(array_key_exists('p_image', $cartdata['options']))
													<img src="{{asset('uploads/product/'.$cartdata['options']['p_image'])}}"  alt="">   
													@endif
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">{{$cartdata['name']}}</a></h3>
													<h4 class="product-price"><span class="qty">{{$cartdata['qty']}}x</span>&#2547;{{$cartdata['price']}}</h4>
												</div>
												<a href="{{route('product.add_to_cart-delete',$cartdata['rowId'])}}" class="delete"><i class="fa fa-close"></i></a>
											</div>
											@endforeach
	
										</div>
										<div class="cart-summary">
											<small>{{count($cartArray)}} Item(s) selected</small>
											<h5>SUBTOTAL: &#2547;{{Cart::subtotal()}}</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="{{route('product.checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->

		</header>
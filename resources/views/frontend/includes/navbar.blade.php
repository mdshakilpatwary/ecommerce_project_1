<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="{{ Route::is('frontend_site*') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
						<li class="{{ Route::is('show.all.product*') ? 'active' : '' }}"><a href="{{route('show.all.product')}}">All Product</a></li>
						@foreach($categories as $category)
						<li class="{{ Route::is('show.category.product*') ? 'active' : '' }}"><a href="{{route('show.category.product',$category->id)}}">{{$category->cat_name}}</a></li>
						@endforeach

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
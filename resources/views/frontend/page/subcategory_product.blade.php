
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
							<li><a href="#"> {{$subcategory->subcat_name}}</a></li>
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
				<div class="row" class="">
					<!-- ASIDE -->
					@include('frontend.includes.pruduct_sidebar_widget')
					<div id="store"  class="col-md-9">
						<!-- store top filter -->
						@include('frontend.includes.product_sorting_filter')
						<!-- /store top filter -->
							@if (count($products) > 0)
							<div class="all-filter-product" id="all-filter-product">
								@include('frontend.page.search_filter_product')
							</div>
							@else
							<h4 class="text-center">Empty this Sub Category Wise Product </h4>
							@endif
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection
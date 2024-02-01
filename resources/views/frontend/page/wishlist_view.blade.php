<?php
$wishlistArray = wishlistArray();
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
						<h3 class="breadcrumb-header">Wishlist</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Wishlist</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
@if(count($wishlistArray)!=0)

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <div class="cart-item-table" style="width: 100%; overflow-x: scroll;" >
                <table class="table table-hover" style="border-collapse: collapse;">
                    <thead>
                      <tr >
                        <th scope="col">#SL</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sl = 1;
                        @endphp
						@foreach($wishlistArray as $cartdata)
                                        <tr>
                                <th scope="row" style="vertical-align: middle;">{{$sl++}}</th>
                                <td style="width: 300px">
                                    <a href="{{route('single.product',$cartdata->p_id)}}">{{$cartdata->p_name}}</a>                           
                                </td>
                                <td style="vertical-align: middle;">
                                    <img src="{{asset('uploads/product/'.$cartdata->p_image)}}"  alt="" style="width: 50px">                              
                                </td>
        
                                <td style="vertical-align: middle;">&#2547;{{$cartdata->p_price}}</td>
                                <td style="vertical-align: middle;">
                                    <a href="{{route('product.add_to_wishlist-delete',$cartdata->id)}}" class="delete">Remove</a>
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>

@else
<section>
    <div class="container">
        <h4 class="text-danger text-center">Please Add your product on wishlist <a href="{{route('frontend_site')}}">Click here</a></h4>
    </div>
</section>
@endif


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
				dataType: "json",
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
				dataType: "json",
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





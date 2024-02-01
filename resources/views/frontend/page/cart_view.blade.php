<?php
$cartArray =cartArray();
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
						<h3 class="breadcrumb-header">Cart</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Cart List</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
@if(count($cartArray)!=0)

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
                        <th scope="col">Size/Liter</th>
                        <th scope="col">color</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $sl = 1;
                        @endphp
                        @foreach($cartArray as $cartdata)
                            <tr>
                                <th scope="row" style="vertical-align: middle;">{{$sl++}}</th>
                                <td style="width: 300px">
                                    <a href="{{route('single.product',$cartdata['id'])}}">{{$cartdata['name']}}</a>                            </td>
                                <td style="vertical-align: middle;">
                                    @if(array_key_exists('p_image', $cartdata['options']))
                                    <img src="{{asset('uploads/product/'.$cartdata['options']['p_image'])}}"  alt="" style="width: 50px;">   
                                    @endif                            
                                </td>
                                <td style="vertical-align: middle;">
                                    @if($cartdata['options']['size'] != null)
                                        {{$cartdata['options']['size']}}
                                    @else
                                        <span>none</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">
                                    @if($cartdata['options']['color'] != null)
                                        {{$cartdata['options']['color']}}
                                    @else
                                        <span>none</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle; width:90px;">
                                    
                                    <div class="input-number">
										<input type="number" name="quantity" class="quantity" value="{{$cartdata['qty']}}">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
                                </td>
                                <td style="vertical-align: middle;">&#2547;{{$cartdata['price']}}</td>
                                <td style="vertical-align: middle;">
                                    <a href="{{route('product.add_to_cart-delete',$cartdata['rowId'])}}" class="delete">Remove</a>                            
                                </td>
                            </tr>
                        @endforeach
    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right"><small>{{count($cartArray)}} Item(s) selected</small>
                            </th>
                            <th><b>Total :</b></th>
                            <th>&#2547;{{Cart::subtotal()}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="chackout-btn text-right">
                    <a class="btn btn-success" href="{{route('product.checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<section>
    <div class="container">
        <h4 class="text-danger text-center">Please Add your product on Cart-box <a href="{{route('frontend_site')}}">Click here</a></h4>
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





<?php
 ?>

<div class="modal fade-center" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

				<div class="row">
					
										<!-- Product main img -->
										<div class="col-md-6">
											<div id="product-main-img-quick-product">
												<!-- multiple img show  -->
												
											
												
											 	
												
											</div>
											<hr>
											<div id="product-main-img-quick-btn">					
											
											</div>
										</div>
										<!-- /Product main img -->
					
										<!-- Product thumb imgs -->
										
										<!-- /Product thumb imgs -->
					
										<!-- Product details -->
										<div class="col-md-6">
											<div class="product-details">
												<h2 id="product-name-modal" class="product-name"></h2>
												<div id="discount-info-modal">
													
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
													<h3 class="product-price" ><span id="product-price-modal"></span><del class="product-old-price" id="product-old-price-modal"></del></h3>

													<span class="product-available" id="product-available-modal"></span>
												</div>
												<form action="{{route('product.add_to_cart')}}" method="POST">
													@csrf
					
												<div class="product-options">
													<label  style="padding-bottom: 10px">
														<span id="product-option-label-modal"></span>
														<select class="input-select" id="product-option-select-size-modal" name="size">
															
														</select>
													</label>
													<label>
														Color
					
														<select class="input-select" name="color" id="product-option-select-color-modal">
															
														</select>
													</label>
												</div>
												<div class="add-to-cart" >
													<div class="qty-label" style="margin-bottom: 10px !important;">
														Qty
														<div class="input-number ">
															<input type="number" name="quantity" value="1" >
															<span class="qty-up">+</span>
															<span class="qty-down">-</span>
														</div>
														@error('quantity')
														<p class="text-danger pt-1">{{$message}}</p>
														@enderror
													</div>
													<input type="hidden" class="product_id-modal" name="product_id" value="">
					
													<button id="add-to-cart-btn-modal"  class="add-to-cart-btn"></button>
													
												</div>
												
												</form>
					
												<ul class="product-btns">
													<form style="display: inline"  action="{{route('product.add_to_wishlist')}}" method="POST">
														@csrf
															<input type="hidden" name="product_id" class="product_id-modal" value="">
														@if(Auth::user())
														{{-- wishlist --}}
															<li><a id="wislist-modal-btn"></a></li>
					
														@else
														<li><a ><button style="background: none; border:none;"><i class="fa fa-heart-o"></i> ADD TO WISHLIST</button></a></li>
					
														@endif
														</form>
													<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
												</ul>
					
												<ul class="product-links" id="product-links-modal">
													
												</ul>
					
												
					
											</div>
										</div>
										<!-- /Product details -->
				</div>
            </div>
            
        </div>
    </div>
</div>




<script>

// quick view modal ajax code start 
$(document).ready(function(){
	$('.quick-view').click(function(){
		let id = $(this).val();
		
		$.ajax({
                url: "{{url('quick/view/modal')}}"+ id,
                type: 'get',
				dataType: "json",
                success: function(response) {

					$('#product-name-modal').text(response.product_quick.p_name);
					$('.product_id-modal').val(response.product_quick.id);
					if (response.product_quick.discount_percentage > 0) {
                        $('#discount-info-modal').html('<span class="bg-success">Discount ' + response.product_quick.discount_percentage + '%</span>');
                    } else {
                        $('#discount-info-modal').html('<span class="bg-warning">No Discount</span>');
                    }
					$('#product-price-modal').html('&#2547;'+ (response.product_quick.p_price -(response.product_quick.p_price*(response.product_quick.discount_percentage/100))));
					$('#product-old-price-modal').html('&#2547;'+ response.product_quick.p_price);
					
					if (response.product_quick.p_qty != 0) {
                        $('#product-available-modal').text('In Stock');
                    }
					else{
						$('#product-available-modal').text('Out of Stock');
					}
					if (response.product_quick.size_id != null) {
                        $('#product-option-label-modal').text('Size');
                    }
					else{
						$('#product-option-label-modal').text('Kg/Liter');
					}


					// size data show 
					$('#product-option-select-size-modal').empty();
                    $.each(response.size_quick, function(index, size) {
                        $('#product-option-select-size-modal').append('<option value="' + size + '">' + size + '</option>');
                    });
					// color data show 
					$('#product-option-select-color-modal').empty();
                    $.each(response.color_quick, function(index, color) {
                        $('#product-option-select-color-modal').append('<option value="' + color + '">' + color + '</option>');
                    });

					// add to cart btn 
					if (response.product_quick.p_qty != 0) {
                        $('#add-to-cart-btn-modal').html('<i class="fa fa-shopping-cart"></i> Add To Cart');
                    }
					else{
						$('#add-to-cart-btn-modal').html('<i class="fa fa-shopping-cart"></i>Stock Out').prop('disabled', true).css('background-color', 'black');
					}

					$('#product-links-modal').html('<li>Category : </li><li>'+response.category+'</li>');
                    
					// image  show 
					$('#product-main-img-quick-product').empty();

					// Add the images to the container dynamically
					$.each(response.imageUrls, function (index, imageUrl) {
						
						$('#product-main-img-quick-product').append('<div class="product-preview product_modal_main_image w-75"><img src="' + imageUrl + '" alt=""></div>');
					});
					// image  show 
					$('#product-main-img-quick-btn').empty();

					// Add the images to the container dynamically
					$.each(response.imageUrls, function (index, imageUrl) {
						
						$('#product-main-img-quick-btn').append('<div class="product-preview product_modal_main_image w-75"><img style="max-width: 80px; border:1px solid #ddd;" src="' + imageUrl + '" alt=""></div>');
					});

					// wishlist 
					if (response.wishlistModal) {
                        $('#wislist-modal-btn').html('<button disabled style="background: none; border:none;"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>');
                    }
					else{
                        $('#wislist-modal-btn').html('<button style="background: none; border:none;"><i class="fa fa-heart-o"></i> ADD TO WISHLIST</button>');
					}
					


		// product modal image code start
		$('#productModal').on('hidden.bs.modal', function () {
			// Destroy existing sliders
			$('#product-main-img-quick-product, #product-main-img-quick-btn').slick('unslick');
		});
			// Function to initialize Slick sliders
			function initializeSliders() {
				$('#product-main-img-quick-product').slick({
					initialSlide: 1,
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					speed: 300,
					dots: false,
					fade: true,
					asNavFor: '#product-main-img-quick-btn',
				});

				$('#product-main-img-quick-btn').slick({
					slidesToShow: 3,
					initialSlide: 1,
					slidesToScroll: 1,
					centerMode: true,
					focusOnSelect: true,
					centerPadding: 0,
					asNavFor: '#product-main-img-quick-product',
					responsive: [{
						breakpoint: 991,
						settings: {
							vertical: false,
							arrows: false,
							dots: true,
						}
					}]
				});
			}

		// Initialize sliders when the document is ready
			initializeSliders();

		// product modal code end


                },
            });

	});


	
});
// quick view modal ajax code end



</script>




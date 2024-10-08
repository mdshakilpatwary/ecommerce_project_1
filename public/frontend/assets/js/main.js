(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})


	// Fix cart dropdown from closing
    $('.product-cart-btn').click(function(cart){
        cart.stopPropagation();
        $('.product-dropdown-cart').toggle();
		$('.product-wishlist-dropdown').hide();


    });
    $(document).click(function(event){
		if (!$(event.target).closest('.product-cart-btn').length && !$(event.target).closest('.product-dropdown-cart').length) {
            // If the click was not inside product-cart-btn or product-cart-dropdown, hide the dropdown
            $('.product-dropdown-cart').hide();
        }
    });
// wishlist code 
	$('.product-wishlist-btn').click(function(wishlist){
        wishlist.stopPropagation();
        $('.product-wishlist-dropdown').toggle();
		$('.product-dropdown-cart').hide();

    });
	
	$(document).click(function(){
        $('product-wishlist-dropdown').hide();
    });

	$(document).click(function(event){
		if (!$(event.target).closest('.product-wishlist-btn').length && !$(event.target).closest('.product-wishlist-dropdown').length) {
            // If the click was not inside product-cart-btn or product-cart-dropdown, hide the dropdown
            $('.product-wishlist-dropdown').hide();
        }
    });
	// $('.product-wishlist-btn').click(function(){
	// 	$('.product-wishlist-dropdown').toggle();

	// });

	/////////////////////////////////////////

	// Products category Slick
	$('.products-slick-category').slick({
		
		infinite: true,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		responsive: [
		  {
			breakpoint: 1024,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  infinite: true,
			  
			}
		  },
		  {
			breakpoint: 776,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			  infinite: true,
			  
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			  infinite: true,

			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  infinite: true,

			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			vertical: true,
			autoplay: true,
			slidesToShow: 2,
			slidesToScroll: 1,			
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	// home page banner slider
	
		$('.home-page-banner').slick({
			dots: true,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			autoplay: true,
			adaptiveHeight: true,
			appendArrows: false,

		});


	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}
	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img-product');
	if (zoomMainProduct) {
		$('#product-main-img-product .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 100000],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 100000
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);



// alert message show hide part js 

setTimeout(function() {
    $('.alertsuccess').slideUp(1000);
 },5000);


setTimeout(function() {
    $('.alerterror').slideUp(1000);
 },5000);
// review message show hide part js 

setTimeout(function() {
    $('.insert_success').slideUp(1000);
 },2000);


setTimeout(function() {
    $('.insert_error').slideUp(1000);
 },3000);








  




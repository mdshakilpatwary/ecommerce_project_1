		<!-- jQuery Plugins -->

		<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> 
		<script src="{{asset('frontend/assets')}}/js/jquery.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/pagination.js"></script>
		  <!-- JS data table -->
		<script src="{{asset('frontend/assets')}}/js/bootstrap.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/slick.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/nouislider.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/jquery.zoom.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/main.js"></script>

		
@yield('customeJavascripti')
<script>
	function reviewInsert(){
		var review_product_id = $('#review_product_id').val();
		var review_name = $('#review_name').val();
		var review_email = $('#review_email').val();
		var review = $('#review').val();
		var review_rating = $("input[name='review_rating']:checked").val();

			    // review form validation
				if (review_name === '') {
                    showError('Required review name field');
                } else if (review_email === '' || !isValidEmail(review_email)) {
                    showError('Invalid or required review email field');
                } else if (review === '') {
                    showError('Required review field');
                } else if (review_rating === '' || isNaN(review_rating) || review_rating < 1 || review_rating > 5) {
                    showError('Invalid or required review rating');
                } else {
                    // If all validations pass, you can proceed with form submission or other actions
                    $('.insert_error').text(''); // Clear any existing error messages
                    // Perform form submission or other actions here
                    console.log('Form submitted successfully!');
                }
            

            function showError(message) {
                $('.insert_error').text(message).fadeIn(500).delay(5000).fadeOut(500);
            }

            function isValidEmail(email) {
                // Simple email validation, you might want to improve it
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
						
						
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

			$.ajax({
					url: "{{url('product/review')}}",
					type: 'post',
					dataType: "json",
	
					// data: $('#reviewInsertForm').serialize(),
					data: {
						review_name: review_name,
						review_email: review_email,
						review_product_id: review_product_id,
						review: review,
						review_rating: review_rating,
							
						},
					success: function(response) {
						if(response.status == 'ok'){

							$('.insert_success').text(response.message).fadeIn(500).delay(5000).fadeOut(500);
							$('#review_name').val('');
							$('#review_email').val('');
							$('#review').val('');
							$("input[name='review_rating']").prop('checked', false);

						}
						else if(response.status == 'not ok'){
							
							$('.insert_error').text(response.message);
						}
	
					},
					error: function(error) {
					
					}
				});	
				review_show();							

	}
	review_show();							
	function review_show(){
		let single_product_id = $('#single_product_id').val();
		
		$.ajax({
					url: "{{url('product/review/show')}}"+ single_product_id,
					type: 'get',
					dataType: "json",
					success: function(res){
						if(res.review_count >0){
							$('#public_review_part').empty();
							$.each(res.reviewdata , function(key, val){
							// time and date equation 
							var date = new Date(val.created_at);

							var day = date.getDate();
							var month = date.toLocaleString('en-US', { month: 'short' });
							var year = date.getFullYear();
							var hours = date.getHours();
							var minutes = date.getMinutes();
							var ampm = hours >= 12 ? 'PM' : 'AM';

							// Adjust hours to 12-hour format
							hours = hours % 12;
							hours = hours ? hours : 12;

							// Add leading zero to minutes if needed
							minutes = minutes < 10 ? '0' + minutes : minutes;

							var formattedDateTime = month + ' ' + day + ', ' + year + ' - ' + hours + ':' + minutes + ' ' + ampm;

							
							$('#public_review_part').append('<li class="review_items ">\
								<div class="review-heading">\
									<h5 class="name" id="reviewer_name">'+val.name+'</h5>\
									<p class="date" id="reviewer_date">'+formattedDateTime+'</p>\
									<div class="review-rating" id="review_rating_start">'+
							(val.rating === 5 ? '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>' :
							(val.rating === 4 ? '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o empty"></i>' :
								(val.rating === 3 ? '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i>' :
									(val.rating === 2 ? '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i>' : '<i class="fa fa-star"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i><i class="fa fa-star-o empty"></i>')))) 
							+'</div></div>\
							<div class="review-body" id="reviewer_review">\
								<p>'+val.review+'</p>\
								</div>\
							</li>');

								
							if(res.review_count >3){
								$('.review_pagination').rpmPagination({
								domElement: '.review_items',
								limit:2
								});
							}
							
								
							});

						}
						else{
							$('#public_review_part').html('<h3 class="text-center">No review here</h3>');

						}
							
							
							$('#review_count').text('('+res.review_count+')');
							$('#review_count_top').text('('+res.review_count+')');
						}
				});
	}
	
	
</script>

		

</body>
</html>

		<!-- jQuery Plugins -->

		<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> 
		<script src="{{asset('frontend/assets')}}/js/jquery.min.js"></script>
		{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script> --}}
		<script src="{{asset('frontend/assets')}}/js/pagination.js"></script>
		  <!-- JS data table -->
		<script src="{{asset('frontend/assets')}}/js/bootstrap.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/slick.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/nouislider.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/jquery.zoom.min.js"></script>
		<script src="{{asset('frontend/assets')}}/js/main.js"></script>

		
@yield('customeJavascripti')
@include('frontend.includes.ajax_script_code')


		

</body>
</html>

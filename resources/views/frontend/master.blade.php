
@include('frontend.includes.head')
<?php
$id = 1;
 $siteInfo= App\Models\SiteInfo::find($id);
 
?>
 
		<!-- HEADER -->
@include('frontend.includes.header')

		<!-- /HEADER -->

		<!-- NAVIGATION -->
@include('frontend.includes.navbar')
		<!-- /NAVIGATION -->

<main>
	

@yield('mainbody')

</main>

		<!-- NEWSLETTER -->
@include('frontend.includes.nawsletter')

		<!-- /NEWSLETTER -->
		<!-- modal -->
@include('frontend.includes.quick_view_modal')


		<!-- FOOTER -->

@include('frontend.includes.footer')
		<!-- /FOOTER -->

@include('frontend.includes.script')


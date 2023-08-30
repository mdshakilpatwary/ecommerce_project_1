@include('frontend.includes.head')
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
		<!-- FOOTER -->
@include('frontend.includes.footer')
		<!-- /FOOTER -->

@include('frontend.includes.script')

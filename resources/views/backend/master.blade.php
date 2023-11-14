@include('backend.includes.head')
<?php
$id = 1;
 $siteInfo= App\Models\SiteInfo::find($id);
 
 ?>
@include('backend.includes.head')
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
	  <!-- header navbar part start  -->
	  @include('backend.includes.header')
	<!-- header navbar part end  -->
	  <!-- sidebar part start  -->
	  @include('backend.includes.sidebar')
	<!-- sidebar part end  -->

    
      <!-- Main Content -->
      <div class="main-content">

	  @yield('maincontent')
		<!-- setting toggle part start  -->
		@include('backend.includes.settingToggle')
		<!-- setting toggle part end -->
      </div>
	  @include('backend.includes.footer')
    </div>
  </div>
@include('backend.includes.script')
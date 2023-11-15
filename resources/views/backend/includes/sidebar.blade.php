<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            @if($siteInfo->main_logo == '')
            <a href="{{route('admin.dashboard')}}"> <img alt="image" src="{{asset('backend')}}/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">{{$siteInfo->name}}</span>
            </a>
            @else
            <a href="{{route('admin.dashboard')}}"> <img alt="image" src="{{asset('uploads/info/'.$siteInfo->main_logo)}}" class="header-logo" /> <span
                class="logo-name">{{$siteInfo->name}}</span>
            </a>
            @endif
          </div>
          <ul class="sidebar-menu pb-5">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ Route::is('create.product*') || Route::is('admin.dashboard*') ? 'active' : '' }}">
              <a href="{{route('admin.dashboard')}}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown ">
              <a href="{{route('frontend_site')}}" target="blank" class="nav-link"><i data-feather="monitor"></i><span>View site</span></a>
            </li>

            <li class="menu-header">Product Elements</li>
            <li class="dropdown {{ Route::is('create.product*') || Route::is('show.product*') || Route::is('edit.product*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-box"></i><span>Product</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.product')}}">Add Product</a></li>
                <li><a class="nav-link" href="{{route('show.product')}}">Manage Product</a></li>
              </ul>
            </li>
            <li class="dropdown {{ Route::is('create.catagory*') || Route::is('show.catagory*') || Route::is('edit.catagory*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Category</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.catagory')}}">Add Category</a></li>
                <li><a class="nav-link" href="{{route('show.catagory')}}">Manage Category</a></li>
              </ul>
            </li>
            <li class="dropdown {{ Route::is('create.subcatagory*') || Route::is('show.subcatagory*') || Route::is('edit.subcatagory*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Sub Category</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.subcatagory')}}">Add Sub Category</a></li>
                <li><a class="nav-link" href="{{route('show.subcatagory')}}">Manage Sub Category</a></li>
              </ul>
            </li>
            <li class="dropdown {{ Route::is('create.brand*') || Route::is('show.brand*') || Route::is('edit.brand*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Brand</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.brand')}}">Add Brand</a></li>
                <li><a class="nav-link" href="{{route('show.brand')}}">Manage Brand</a></li>
              </ul>
            </li>

            <li class="dropdown {{ Route::is('create.size*') || Route::is('show.size*') || Route::is('edit.size*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Size</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.size')}}">Add Size</a></li>
                <li><a class="nav-link" href="{{route('show.size')}}">Manage Size</a></li>
              </ul>
            </li>
            <li class="dropdown {{ Route::is('create.color*') || Route::is('show.color*') || Route::is('edit.color*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layers"></i><span>Color</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('create.color')}}">Add Color</a></li>
                <li><a class="nav-link" href="{{route('show.color')}}">Manage Color</a></li>
              </ul>
            </li>
            <li class="menu-header">Customer Order Elements</li>
            <li class="dropdown {{ Route::is('order.product*') || Route::is('order.product.details*') || Route::is('order.order.invoice*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-box"></i><span>Customer Order</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('order.product')}}">Customer Order</a></li>
                
              </ul>
            </li>
            



          

          </ul>
        </aside>
      </div>
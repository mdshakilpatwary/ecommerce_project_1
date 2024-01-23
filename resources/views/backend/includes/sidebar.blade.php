<div class="main-sidebar sidebar-style-2 pb-5">
        <aside id="sidebar-wrapper ">
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
              <a href="{{route('frontend_site')}}" target="blank" class="nav-link"><i data-feather="server"></i><span>View site</span></a>
            </li>
          @if(Auth::user()->can('admin.create') || Auth::user()->can('admin.view'))

            <li class="menu-header">User Elements</li>
            <li class="dropdown {{ Route::is('user.create*') || Route::is('user.manage*') || Route::is('user.edit*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-user"></i><span>User</span></a>
              <ul class="dropdown-menu">
                @if(Auth::user()->can('admin.create'))
                <li><a class="nav-link" href="{{route('user.create')}}">User Create</a></li>
                @endif
                @if(Auth::user()->can('admin.view'))
                <li><a class="nav-link" href="{{route('user.manage')}}">User Manage</a></li>
                @endif
                
              </ul>
            </li>
          @endif

          @if(Auth::user()->can('product.view') || Auth::user()->can('product.create'))
            <li class="menu-header">Product Elements</li>
            <li class="dropdown {{ Route::is('create.product*') || Route::is('show.product*') || Route::is('edit.product*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-store"></i><span>Product</span></a>
              <ul class="dropdown-menu">
                @if( Auth::user()->can('product.create'))
                <li><a class="nav-link" href="{{route('create.product')}}">Add Product</a></li>
                @endif
                <li><a class="nav-link" href="{{route('show.product')}}">Manage Product</a></li>
              </ul>
            </li>
            @if( Auth::user()->can('product.create'))
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
            @endif
          @endif
            @if(Auth::user()->can('order.view'))

              <li class="menu-header">Customer Order Elements</li>
              <li class="dropdown {{ Route::is('order.product*') || Route::is('order.product.details*') || Route::is('order.order.invoice*') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-box"></i><span>Customer Order</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{route('order.product')}}">Customer Order</a></li>
                  
                </ul>
              </li>

            @endif
            @if(Auth::user()->can('role.create') || Auth::user()->can('role.view'))

            <li class="menu-header">Role and Permission Elements</li>
            <li class="dropdown {{ Route::is('role.permission.create*') || Route::is('role.permission.manage*') || Route::is('role.permission.edit*') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Role and Permission</span></a>
              <ul class="dropdown-menu">
                @if(Auth::user()->can('role.create'))
                <li><a class="nav-link" href="{{route('role.permission.create')}}">Role Create</a></li>
                @endif
                @if(Auth::user()->can('role.view'))
                <li><a class="nav-link" href="{{route('role.permission.manage')}}">Role Manage</a></li>
                @endif
              </ul>
            </li>
            @endif
            {{-- @if(Auth::user()->can('admin.create') || Auth::user()->can('admin.view')) --}}

            <li class="menu-header">Offer and Review Elements</li>
            <li class="dropdown {{ Route::is('offer.content*')? 'active' : '' }}">
              <a href="{{route('offer.content')}}" class="nav-link"><i class="fas fa-puzzle-piece"></i><span>Offer Content</span></a>
            </li>

            <li class="dropdown {{ Route::is('review.show.all*') || Route::is('review.single.product*')? 'active' : '' }}">
              <a href="{{route('review.show.all')}}" class="nav-link"><i class="fas fa-puzzle-piece"></i><span>Product Reviews</span></a>
            </li>
          {{-- @endif --}}
            @if(Auth::user()->can('admin.create') || Auth::user()->can('admin.view'))

            <li class="menu-header">Additional Setting Elements</li>
            <li class="dropdown {{ Route::is('include.another.create*')? 'active' : '' }}">
              <a href="{{route('include.another.create')}}" class="nav-link"><i class="fas fa-puzzle-piece"></i><span>Additional Setting</span></a>
            </li>
          @endif

            



          

          </ul>
        </aside>
      </div>
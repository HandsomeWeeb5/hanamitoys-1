<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('admin') }}" class="brand-link">
    <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Hanami Toys</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="nav-link {{ (request()->is('admin')) ? 'active' : ((request()->is('admin/dashboard')) ? 'active' : '') }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dasbor</p>
          </a>
        </li>
        <li class="nav-header">E - COMMERCE</li>
        <li class="nav-item">
          <a href="{{ url('admin/categories') }}" class="nav-link {{ (request()->segment(2) == 'categories') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list-ul"></i>
            <p>
              Kategori
              <span class="badge badge-info right">{{ $categoriesCount ?? '' }}</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/products') }}" class="nav-link {{ (request()->segment(2) == 'products') ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Produk
              <span class="badge badge-info right">{{ $productsCount ?? '' }}</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/attributes') }}" class="nav-link {{ (request()->segment(2) == 'attributes') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Atribut
              <span class="badge badge-info right">{{ $atributesCount ?? '' }}</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/orders') }}" class="nav-link {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Order
              <span class="badge badge-info right">{{ $ordersCount ?? '' }}</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/shipments') }}" class="nav-link {{ (request()->segment(2) == 'shipments') ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Pengiriman
              <span class="badge badge-info right">{{ $shipmentsCount ?? '' }}</span>
            </p>
          </a>
        </li>
        <li class="nav-header">PENGATURAN</li>
        <li class="nav-item">
          <a href="{{ url('admin/users') }}" class="nav-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User
              <span class="badge badge-info right">{{ $usersCount ?? '' }}</span>
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="{{ url('admin/roles') }}" class="nav-link {{ (request()->segment(2) == 'roles') ? 'active' : '' }}">
        <i class="nav-icon fas fa-key"></i>
        <p>
          Role
          <span class="badge badge-info right">2</span>
        </p>
        </a>
        </li> --}}
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <!-- Footer -->
  <div class="sidebar-custom">
    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="display: block;">
      {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>
  <!-- /.Footer -->
</aside>
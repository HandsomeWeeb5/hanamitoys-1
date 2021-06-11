<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('admin') }}" class="brand-link">
    <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
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
          <a href="{{ url('admin/categories') }}" class="nav-link {{ (request()->is('admin/categories')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-list-ul"></i>
            <p>
              Kategori
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/products') }}" class="nav-link {{ (request()->is('admin/products')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Produk
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <!-- Footer -->
  <div class="sidebar-custom">
    <a href="#" class="btn btn-danger" style="display: block;">Logout</a>
  </div>
  <!-- /.Footer -->
</aside>
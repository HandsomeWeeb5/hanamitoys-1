<nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/customer/img/site-id-text.png') }}" alt="site-id" height="50" />
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <form action="{{ route('cproducts.index') }}" method="GET" class="form-inline my-2 my-lg-0 search-box">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="q" value="{{ $q ?? '' }}">
        <button class="btn input-group-btn fa fa-search shadow-none" type="submit"></button>
      </form>
      <ul class="navbar-nav ml-lg-auto navbar-nav-1">
        @role('Customer')
        <li class="nav-item px-lg-1" data-toggle="tooltip" data-placement="bottom" title="Cart">
          <a class="nav-link" href="{{ url('carts') }}">
            <div class="icon-container">
              <img src="{{ asset('assets/customer/img/shopping-cart.png') }}" alt="shopping-cart" />
            </div>
          </a>
        </li>
        @auth
        <li class="nav-item px-lg-1" data-toggle="tooltip" data-placement="bottom" title="Order Detail">
          <a class="nav-link" href="{{ url('orders') }}">
            <div class="icon-container">
              <img src="{{ asset('assets/customer/img/transaction.png') }}" alt="transaction" />
            </div>
          </a>
        </li>
        @endauth
        @endrole
        @guest
        <li class="nav-item px-lg-1" data-toggle="tooltip" data-placement="bottom" title="Login">
          <a class="nav-link" href="{{ route('login') }}">
            <div class="icon-container">
              <img src="{{ asset('assets/customer/img/login symbol.png') }}" alt="login" />
            </div>
          </a>
        </li>
        @endguest
        @auth
        <li class="nav-item px-lg-1" data-toggle="tooltip" data-placement="bottom" title="Logout">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon-container">
              <img style="transform: scaleX(-1); -webkit-transform: scaleX(-1)" src="{{ asset('assets/customer/img/login symbol.png') }}" alt="login" />
            </div>
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        @endauth
      </ul>
      <ul class="navbar-nav menu-bar navbar-nav-2">
        <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'products') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('cproducts.index') }}">Products</a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'about') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item {{ (request()->segment(1) == 'contact') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
        </li>
        @auth
        <li class="nav-item {{ (request()->segment(1) == 'account') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('account.index') }}">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
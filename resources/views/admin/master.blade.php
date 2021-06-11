<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hanami Toys - Admin | @yield('title')</title>

  {{-- Font --}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
  @yield('css')
</head>

<body class="hold-transition layout-fixed">
  <div class="wrapper">

    {{-- PreLoader --}}
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    {{-- Navbar --}}
    @include('admin.layouts.navbar')

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    {{-- Content Wrapper --}}
    <div class="content-wrapper">
      @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
      </div>
    </footer>

    {{-- Controller Theme Sidebar --}}
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  {{-- Script --}}
  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/sparklines/sparkline.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js"></script>
  <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
  @yield('scripts')
</body>

</html>
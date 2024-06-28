@include('partials.header')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('partials.footer')
<!-- ./wrapper -->

@include('partials.scripts')
@yield('scripts')
</body>
</html>
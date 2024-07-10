<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Absen Guru SMKN 9</span>
  </a>



  <!-- Sidebar -->
  <div class="sidebar">

  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="info">
      <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
  </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-3">
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
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">Guru</li>
        <li class="nav-item">
          <a href="{{ route('data-guru.index') }}" class="nav-link {{ request()->routeIs('data-guru.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Data Guru</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('data-absen-guru') }}" class="nav-link {{ request()->routeIs('data-absen-guru') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Rekap Absen Guru</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('log-guru.index') }}" class="nav-link {{ request()->routeIs('log-guru.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Log Guru</p>
          </a>
        </li>
        <li class="nav-header">Tata Usaha</li>
        <li class="nav-item">
          <a href="{{ route('data-tata-usaha.index') }}" class="nav-link {{ request()->routeIs('data-tata-usaha.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Data Tata usaha</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('data-absen-tata-usaha') }}" class="nav-link {{ request()->routeIs('data-absen-tata-usaha') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Rekap Absen Tata Usaha</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('log-tata-usaha.index') }}" class="nav-link {{ request()->routeIs('log-tata-usaha.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Log Tata Usaha</p>
          </a>
        </li>
        <li class="nav-header">Satpam</li>
        <li class="nav-item">
          <a href="{{ route('data-satpam.index') }}" class="nav-link {{ request()->routeIs('data-satpam.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Data Satpam</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('data-absen-satpam') }}" class="nav-link {{ request()->routeIs('data-absen-satpam') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Rekap Absen Satpam</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('log-satpam.index') }}" class="nav-link {{ request()->routeIs('log-satpam.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>Log Satpam</p>
          </a>
        </li>
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="{{ route('data-satpam.index') }}" class="nav-link {{ request()->routeIs('data-satpam.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>User Manajemen</p>
          </a>
        </li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
        </form>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tast Managment</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{ asset('/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
      <span class="brand-text font-weight-light">Tast Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/admin.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="brand-text font-weight-light text-white">{{ Auth('admin')->user()->name }}</span>
          <a href="#" class="d-block"></a></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
          <li class="nav-item">
            <a href="/admin/tasks" class="nav-link">
            <i class="nav-icon fa fa-tasks" aria-hidden="true"></i>
              {{-- <img src="./img/tasks.png" class="nav-icon"></img> --}}
              <p>Tasks<span class="right badge badge-success">{{ DB::table('Tasks')->count() }}</span></p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/employees" class="nav-link">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>Empolyees<span class="right badge badge-primary">{{ DB::table('employees')->count() }}</span></p>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="text-red nav-icon fa fa-power-off" aria-hidden="true"></i>
              <p><span>Logout</span></p>
            </a>
            <form id="logout-form" action="{{ route('adminlogout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <div class="content" style="margin-top:20px;">
      <div id="app">
        @yield('content')
      </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Designed and Devoleped By Abdelhakeem Qassem
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="/home">Task Manager</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{ asset('./js/app.js') }}"></script>

</body>
</html>



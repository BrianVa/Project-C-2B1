<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/css/dashboard/font-awesome.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('/css/dashboard/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/css/dashboard/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ url('/css/dashboard/google.css') }}">

    @section('includes_css')

    @show

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class=" fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/dashboard')}}" class="nav-link">Dashboard</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fa fa-th-large"></i>
                </a>
            </li>--}}
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link bg-success">
            <img src="{{ url('/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Cimsolutions</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ url('/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ url('/profiel') }}" class="d-block">
                        @if(isset(Auth::user()->email))
                            {{ Auth::user()->firstname  }} {{ Auth::user()->lastname  }}
                        @else
                            Naam
                        @endif
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                                Account
                                <i class="right fa fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/logout') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>uitloggen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/profiel') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Profiel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/kennissessie/1') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Aanmelden sessie</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(isset(Auth::user()->role_id) == 3)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-address-card"></i>
                                <p>
                                    Beheer
                                    <i class="right fa fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/gebruikers') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Gebruikers Overzicht</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Gebruikers Toevoegen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/kennissessies') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Kennissessies Overzicht</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/kennissessies/toevoegen') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Kennissessies Toevoegen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page_title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('page_title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @section('content')

        @show
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.0.1
        </div>
        <strong>&copy; 2020 <a href="https://www.cimsolutions.nl/nl" target="_blank">CIMSOLUTIONS</a>.</strong> All Rights Reserved.
    </footer>

    <!-- Control Sidebar -->
    {{--<aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>--}}
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ url('/js/dashboard/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/dashboard/bootstrap.bundle.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('/js/dashboard/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('/js/dashboard/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/js/dashboard/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/js/dashboard/extra.js') }}"></script>
@section('includes_js')

@show
@section('jqcode')

@show
</body>
</html>

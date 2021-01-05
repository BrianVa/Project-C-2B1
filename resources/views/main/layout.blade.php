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
    <!-- Datetime -->
    <link rel="stylesheet" href="{{ url('/css/datetimepicker/date.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ url('/css/dashboard/google.css') }}">

    @section('includes_css')

    @show
    <style>
        .msg{
            position: absolute!important;
            top: 0!important;
            right: 0!important;
            z-index: 9999!important;
            margin-top: 3%!important;
            max-width: 500px!important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
@if(session()->has('succesMessage'))
    <div class="alert alert-success msg alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-check"></i> Succes!</h5>
        {{session()->get('succesMessage')}}
    </div>
@endif
@if(session()->has('errorMessage'))
    <div class="alert alert-danger msg alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> Error!</h5>
        {{session()->get('errorMessage')}}
    </div>
@endif
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
                    <img style="width: 35px!important;height: 35px!important;" src="{{ url('/img/profile/images') }}/{{Auth::user()->avatar}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ url('/profiel') }}" class="d-block">
                        @if(isset(Auth::user()->email))
                            {{ Auth::user()->firstname }}  {{ Auth::user()->lastname }}
                        @else
                           Name
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
                        </ul>
                    </li>
                    @if(Auth::user()->role_id > 1)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-address-card"></i>
                                <p>
                                    Beheer
                                    <i class="right fa fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if(Auth::user()->role_id > 2)
                                    <li class="nav-item">
                                        <a href="{{ url('/gebruikers') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>Gebruikers Overzicht</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('/kennissessies/beheer') }}" class="nav-link">
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
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Kennissessies
                                <i class="right fa fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/kennissessies') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Overzicht</p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
            <b>Version</b> 0.0.1 Alpha
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/dashboard/bootstrap.bundle.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('/js/dashboard/jquery.slimscroll.min.js') }}"></script>
<!-- Functions -->
<script src="{{ url('/js/dashboard/functions.js') }}"></script>
<!-- Datetime -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
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

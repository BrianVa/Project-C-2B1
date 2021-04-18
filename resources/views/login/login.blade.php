<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cimsolutions Login</title>
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
<body class="hold-transition login-page">
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
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Cimsolutions</a>
        <img src="{{ url('/img/AdminLTELogo.png') }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8; margin-top: 8px; margin-left: .5rem; margin-right: -2.1rem">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login met uw Email & Wachtwoord</p>

            <form action="{{url('/loggingin')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                </div>
                <button type="submit" name="login" class="btn btn-success btn-block btn-flat" style="border-radius: 4px">Login</button>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p style="margin-top: 0px; margin-bottom: 10px">- ∞ -</p>
                <a data-toggle="modal" data-target="#register" class="text-white btn btn-block btn-success" style="border-radius: 4px">Registreer
                </a>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@extends('main/modals/register')
<!-- jQuery -->
<script src="{{ url('/js/dashboard/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/dashboard/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

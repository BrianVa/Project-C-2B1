<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Cimsolutions</a>
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
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- ∞ -</p>
                <a data-toggle="modal" data-target="#register" class="text-white btn btn-block btn-primary">Registreer
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

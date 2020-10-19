<html>
<head>
    <link rel="stylesheet" href="{{ url('/css/login/main.css') }}">
</head>
<body>
<div class="login">
    @if($message = Session::get('error'))
    <div class="alert alter-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif


    <h1>Login</h1>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
         @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
         @endforeach
        </ul>
    </div>
    @endif
    <div id="login">
        <form method="post" action="{{ url('/loggingin') }}">
            {{ csrf_field() }}
            <input type="text" name="email" placeholder="Email" required="required" />
            <input type="password" name="password" placeholder="Wachtwoord" required="required" />
            <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Inloggen</button>
        </form>
    </div>
</div>
<!-- jQuery -->
<script src="{{ url('/js/dashboard/jquery.min.js') }}"></script>
</body>
</html>

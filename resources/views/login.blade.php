<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Login</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" action="{{route('login')}}" method="POST">
      {!!csrf_field()!!}
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        @if(Session::has('flash_message_danger'))                    
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button> 
              <h1>{!! session('flash_message_danger') !!}</h1>
          </div>
        @endif
        <span class="text-danger">{{$errors->first('username')}}</span>
        <div class="input-group {{($errors->has('username')? 'has-error': '')}}">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name='username' class="form-control" placeholder="Username" autofocus>
        </div>
        <span class="text-danger">{{$errors->first('password')}}</span>
        <div class="input-group {{($errors->has('password')? 'has-error': '')}}">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <div class="text-right"><br>

          <p> <a href="{{ url('/select-school') }}" class="btn btn-success btn-lg btn-block text-white" style="color: white;">Check student's Result</a> </p>
          

        </div>
      </div>
    </form>
    <div class="text-right">
      <div class="credits" style="color: #800000; font-weight: bold;">
          
          System Developed by <a href="" style="color: white">Olayeye Ilemobayo(08169083845)</a>
        </div>
    </div>
  </div>


</body>

</html>

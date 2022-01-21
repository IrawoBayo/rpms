<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Result</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <style>
    .container {
        max-width: 750px;
        margin: 250px auto 0;
    }
    div.result {
        border-style: outset;
        background-color: lightGray;
        padding-top: 10px;
    }
  </style>

</head>

<body class="login-img3-body">
  <div class="container text-center">
    <a href="{{ url('/pri-studentResult') }}">
        <div class="primary col-sm-3 result">
            <img src="img/header2.jpg" alt="">
            <h3>Primary School Result</h3>
        </div>
    </a>
    <div class="primary col-sm-1">
        <h3 class="text-center"></h3>
    </div>
    <a href="{{ url('/studentResult') }}">
        <div class="secondary col-sm-3 result">
            <img src="img/header2.jpg" alt="">
            <h3>Junior Secondary School Result</h3>
        </div>
    </a>
    <div class="primary col-sm-1">
        <h3 class="text-center"></h3>
    </div>
    <a href="{{ url('/ss-studentResult') }}">
        <div class="secondary col-sm-3 result">
            <img src="img/header2.jpg" alt="">
            <h3>Senior Secondary School Result</h3>
        </div>
    </a>

  </div>


</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Result</title>
    <!-- bootstrap theme -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}">
    <style>
        body {
            background-color: #800000;
        }
        .container {
          background-color: white;
        }
        .return {
            max-width: 250px;
            margin:  auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div align="right">
          <img alt="" src="img/header1.jpg">
        </div>
        <hr>
        <div class="return">
            <h3 class="text-danger">Student Not Found</h3>
            <div>
                <a href="{{ url('/select-school') }}"><button class="btn btn-primary">Back To Check Result</button></a>
            </div>
        </div>
        <br>
    </div>
</body>
</html>
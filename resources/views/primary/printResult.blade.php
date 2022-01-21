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
        .info {
            /* border: solid 1px black; */
            margin: 10px;
        }
        .pass {
            position:relative;
            /* width:100px;
            height:100px; */
            /* left:800px; */
            top:-170px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div align="right">
          <img alt="" src="img/header1.jpg" width="650px">
        </div>
        <hr>
        <div style="width:80%; margin:auto;">
            <div>
                <table class="info" cellpadding="10">
                    <tr>
                        <th>FOR: </th>
                        <td>{{ strtoupper($term) }}</td>
                        <td>{{ $sessions->year }}</td>
                        <td>SESSION</td>
                    </tr>
                    <tr>
                        <th>Reg. No.:</th>
                        <td colspan="2">{{ $student->student_id_num }}</td>
                    </tr>
                    <tr>
                        <th>NAME:</th>
                        <td colspan="2">{{ $student->student_name }}</td>
                    </tr>
                        <th>AGE:</th>
                        <td>{{ $age }} Years Old</td>
                        <th>CLASS:</th>
                        <td>{{ $class->class_name }}{{ $class->section }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <img align="right" class="pass" src="/img/student/{{$student->image}}" alt="{{$student->student_name}}" width="150px">
            </div>
            <div class="pass">
                @if($check == 0)
                    <h3>No Result Yet, Please Check Back</h3>
                @else
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Test Score (40)</th>
                                <th>Exam Score (60)</th>
                                <th>Total (100)</th>
                                <th>LTC</th>
                                <th>Final Cum.</th>
                                <th>Grade</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td align="left">{{ $result->subjects->subject_name }}</td>
                                    <td>{{ $result->test_score }}</td>
                                    <td>{{ $result->exam_score }}</td>
                                    <td>{{ $result->total }}</td>
                                    <td> {{ $result->ltc }}</td>
                                    <td> {{ $result->final_cum }}</td>
                                    <td> {{ $result->grade }}</td>
                                    <td> {{ $result->remarks }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td><b>Percentage Total</b></td>
                                <td><b>{{ $percent }}%</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
            <hr>
            <div>
            <table class="info pass" cellpadding="10">
                <tr>
                    <th>CLASS TEACHER'S REMARK: </th>
                    <td>{{ $tRemark->remark }}</td>
                </tr>
                <tr>
                    <th>HEAD TEACHER'S REMARK: </th>
                    <td>{{ $pRemark->remark }}</td>
                </tr>
            </table>
            </div>
        </div>
        <hr>
        <br><br>
        <div>
            <a href="{{ url('/studentResult') }}"><button class="btn btn-primary">Back To Check Result</button></a>
            
            <button class="btn btn-danger" onclick="window.print()" style="float: right;">Print Result</button>
        </div>
        <br>
    </div>
</body>
</html>
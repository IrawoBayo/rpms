@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
						<section class="panel panel-default">

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading" align="text-center">
				<b>Check Student Result</b>
			</header>
                @if($check == 0)
                    <h3>No Result Yet, Please Check Back</h3>
                @else
                <table class="info" cellpadding="10">
                    <tr>
                        <th>FOR: </th>
                        <td>{{ strtoupper($term) }} - {{ $sessions->year }} SESSION</td>
                    </tr>
                    <tr>
                        <th>NAME:</th>
                        <td colspan="2">{{ strtoupper($student->student_name) }}</td>
                    </tr>
                        <th>CLASS:</th>
                        <td>{{ $class->class_name }}{{ $class->section }}</td>
                    </tr>
                </table>
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Test Score (40)</th>
                                <th>Exam Score (60)</th>
                                <th>Total (100)</th>
                                <th>LTC</th>
                                <th>Final Cum.</th>
                                <th>Grade</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1 ?>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{$n++ }}</td>
                                    <td align="left">{{ $result->subjects->subject_name }}</td>
                                    <td>{{ $result->test_score }}</td>
                                    <td>{{ $result->exam_score }}</td>
                                    <td>{{ $result->total }}</td>
                                    <td> {{ $result->ltc }}</td>
                                    <td> {{ $result->final_cum }}</td>
                                    <td> {{ $result->grade }}</td>
                                    <td> {{ $result->remarks }}</td>
                                    <td>
                                        <a href="{{ url('/pri-adminDeleteResult/'.$result->id) }}"><button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this result?')">Delete</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>	
		</section>						
	</div>
</div>

            @endsection
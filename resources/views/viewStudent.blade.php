@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Students</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Student</li>
			<li><i class="fa fa-file-text-o"></i>Manage Student</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading"><b>Student Information</b>
				</div>
				<div class="panel-body" id="add-class-body">


			<table style="width:100%;">


						<tr style="background-color: #800000; color: white;">

						<th style="width: 50%;"><h4 style="font-family: sans-serif; color: white;"><b>Student Name</b></h4></th>

						<td style="width: 50%;"><h4 style="font-family: sans-serif";>{{$student->student_name}}</h4></td>

						</tr>


<tr>
	
<th><h4 style="font-family: sans-serif;"><b>Profile Picture</b></h4></th>

<td style="width: 10%"><h4 style="font-family: sans-serif";><img src="/img/student/{{$student->image}}" alt="{{$student->student_name}}" width="150px"></h4></td>

</tr>


						<tr>
							
						<th><h4 style="font-family: sans-serif;"><b>Student ID number</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->student_id_num}}</h4></td>

						</tr>

						

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Gender</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->gender}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Date of Birth</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->dob}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Student Email</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->student_email}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Student Phone</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->student_phone_number}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>L.G.A</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->lga}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>State of Origin</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->state_of_origin}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Home Address</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->home_address}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Class</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{ $student->class->class_name }}{{ $student->class->section }}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Sponsor Email</b></h4></th>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->sponsor_email}}</h4></td>

						</tr>

						<tr>

						<th><h4 style="font-family: sans-serif";><b>Sponsor Phone Number</b></h4></th>
						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$student->sponsor_phone_number}}</h4></td>

						</tr>
					</table>

					</div>


				
			</div>

			{{-----------------------------}}

			
			
		</section>
						
	</div>

				{{---------}}
</div>

@endsection

@section('script')
	<script type="text/javascript">


		

	</script>

@endsection
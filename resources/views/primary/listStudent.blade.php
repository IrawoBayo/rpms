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
					@if(Session::has('flash_message_success'))                    
	                	<div class="alert alert-success">
	                    	 <button type="button" class="close" data-dismiss="alert">×</button> 
	                         {!! session('flash_message_success') !!}
	                   </div>
	                @endif
					@if(Session::has('flash_message_danger'))                    
	                	<div class="alert alert-danger">
	                    	 <button type="button" class="close" data-dismiss="alert">×</button> 
	                         {!! session('flash_message_danger') !!}
	                   </div>
	                @endif
					@if($students)
						<table class="table table-stripped" id="myTable">
							<thead>
								<tr>
									<th>S/N</th>
									<th>Reg. No.</th>
									<th>Student Name</th>
									<th>Profile Picture</th>
									<th>Gender</th>
									<th>Date of Birth</th>
									<th>Class</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $n = 1; ?>
								@foreach($students as $student)
									<tr>
										<td>{{$n++}}</td>
										<td>{{ $student->student_id_num }}</td>
										<td>{{ $student->student_name }}</td>
										<td><img src="/img/student/{{$student->image}}" alt="{{$student->student_name}}" width="80px"></td>
										<td>{{ $student->gender }}</td>
										<td>{{ $student->dob }}</td>
										<td>{{ $student->class->class_name }}{{ $student->class->section }}</td>
										<td>
										<a href="{{ url('/pri-viewStudent/'.$student->id) }}"><button class="btn btn-warning">View</button></a>
										<a href="{{ url('/pri-editStudent/'.$student->id) }}"><button class="btn btn-info">Edit</button></a>
										<a href="{{ url('/pri-deleteStudent/'.$student->id) }}"><button onclick="return confirm('Are you sure you want to delete this student?')" class="btn btn-danger">Delete</button></a>
									</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
			
			</div>
		</section>
						
	</div>

				{{---------}}
</div>

@endsection

@section('script')
	<script type="text/javascript">

		$(document).ready(function(){
			$('#selectAllBoxes').click(function(event){
				if(this.checked){
					$('.checkBoxes').each(function(){
						this.checked = true;
					});
				}else {
					$('.checkBoxes').each(function(){
						this.checked = false;
					});
				}
			});
		});
		

	</script>

@endsection
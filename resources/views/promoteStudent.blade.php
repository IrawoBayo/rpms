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
					
					<div class="alert alert-danger fade in">
						<h3>* Always promote students from the highest class to the lowest class</h3>
					</div>
					@if($students)
					<form action="" method="post">
						{{csrf_field()}}
						<table class="table table-stripped" id="myTable">
							<div id="bulkOptionContainer" class="col-xs-3">
								<select class="form-control" name="bulk_options" id="" required>
									<option value="">Select Class</option>
									@foreach($classes as $class)
										<option value="{{ $class->class_id }}">{{ $class->class_name }}{{ $class->section  }}</option>
									@endforeach
									<option value="graduate">Graduate</option>
								</select>
							</div>
							<div class="col-xs 2">
								<button class="btn btn-success" type="submit" name="submit" onclick="return confirm('Are you sure you want to PROMOTE these students?')">Promote</button>
							</div>
							<thead>
								<tr>
									<th><input type="checkbox" name="" id="selectAllBoxes"></th>
									<th>Reg. No.</th>
									<th>Student Name</th>
									<th>Gender</th>
									<th>Date of Birth</th>
									<th>Class</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>
								@foreach($students as $student)
									<tr>
										<td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" id="" value="{{ $student->student_id }}"></td>
										<!-- <td>{{$student->student_id}}</td> -->
										<td>{{ $student->student_id_num }}</td>
										<td>{{ $student->student_name }}</td>
										<td>{{ $student->gender }}</td>
										<td>{{ $student->dob }}</td>
										<td>{{ str_replace(' ', '', $student->class->class_name) }}{{ $student->class->section }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</form>
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
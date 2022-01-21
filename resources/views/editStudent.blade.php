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
		<section class="panel panel-default" style="overflow-y: auto; height: 500px;">
			<header class="panel-heading">
				<b>Edit Student</b>
			</header>

			<form action="{{ url('/editStudent/'.$student->student_id) }}" class="form-horizontal" id="frm-create-subject" method="POST" enctype="multipart/form-data">

				{{ csrf_field() }}
				
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						

						<div class="col-sm-2">
							<label for="student_id_num">Registration No.</label>
							<div class="input-group">
								<input type="text" name="student_id_num" id="student_id_num" class="form-control" value="{{ $student->student_id_num }}">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="student_name">Student Fullname</label>
							<div class="input-group">
								<input type="text" name="student_name" id="student_name" class="form-control" value="{{ $student->student_name }}">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="gender">Gender</label>
							<div class="input-group">
								<select class="form-control" name="gender" id="gender">
									<option value="{{ $student->gender }}">{{ $student->gender }}</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								
							</div>		
						</div>

						{{--------------}}
						<div class="col-sm-2">
							<label for="dob">Date Of Birth</label>
							<div class="input-group">
								<input type="text" name="dob" id="dob" class="form-control" value="{{ $student->dob }}">
								
							</div>		
						</div>

						{{--------------}}
						<div class="col-sm-2">
							<label for="class_name">Class</label>
							<div class="input-group">
								<select class="form-control" name="class_id" id="class_id">
								<option value="">Select Class</option>

								@foreach($classes as $Key =>$c)
									<option value="{{ $c->class_id }}" @if($c->class_id == $student->class_id) selected @endif>{{ $c->class_name }}{{ $c->section }}</option>
									@endforeach	
									
								</select>
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="student_email">Student Email</label>
							<div class="input-group">
								<input type="text" name="student_email" id="student_email" class="form-control" value="{{ $student->student_email }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="student_phone_number">Phone Number</label>
							<div class="input-group">
								<input type="text" name="student_phone_number" id="student_phone_number" class="form-control" value="{{ $student->student_phone_number }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="lga">LGA</label>
							<div class="input-group">
								<input type="text" name="lga" id="lga" class="form-control" value="{{ $student->lga }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="home_address">Home Address</label>
							<div class="input-group">
								<input type="text" name="home_address" id="home_address" class="form-control" value="{{ $student->home_address }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="state_of_origin">State of Origin</label>
							<div class="input-group">
								<input type="text" name="state_of_origin" id="state_of_origin" class="form-control" value="{{ $student->state_of_origin }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="sponsor_email">Sponsor Email</label>
							<div class="input-group">
								<input type="text" name="sponsor_email" id="sponsor_email" class="form-control" value="{{ $student->sponsor_email }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="sponsor_phone_number">Sponsor Phone</label>
							<div class="input-group">
								<input type="text" name="sponsor_phone_number" id="sponsor_phone_number" class="form-control" value="{{ $student->sponsor_phone_number }}">
								
							</div>		
						</div>

						<div class="col-sm-4">
							<label for="image">Profile Picture</label>
							<div class="input-group">
								<input type="file" name="image" id="image" class="form-control">
								
							</div>		
						</div>
						
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm">Update Student</button>
				</div>
				
			</form>
			
		</section>
						
	</div>

				{{---------}}
</div>

@endsection

@section('script')
	<script type="text/javascript">
		$('#dob').datepicker({
			changeMonth:true,
			changeYear:true,
			dateFormat:'dd-mm-yy'
		});

		// //=============================
		// $('#end_date').datepicker({
		// 	changeMonth:true,
		// 	changeYear:true,
		// 	dateFormat:'dd-mm-dd'
		// });

		//========================================

		// $('#frm-create-subject').on("submit",function(e){
		// 	e.preventDefault();
		// 	var data = $(this).serialize();
		// 	var url = $(this).attr('action');
		// 	$.post(url,data,function(data){
		// 		console.log(data)
		// 	})
		// })


		

	</script>

@endsection
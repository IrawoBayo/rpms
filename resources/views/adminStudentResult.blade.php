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

			<div class="alert alert-success" style="display:none"></div>

			<form action="{{url('/adminGetStudentResult')}}" class="form-horizontal" id="frm-get-result" method="get">
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="session_id">Year</label>
							<div class="">
								<select class="form-control" name="session_id" id="session_id" required>
									<option value="">Select Year</option>
									@foreach($sessions as $Key =>$s)
									<option value="{{ $s->id }}">{{ $s->year }}</option>
									@endforeach	
									
								</select>								
							</div>	
						</div>	

						<div class="col-sm-3">
							<label for="term">Term</label>
							<div class="">
								<select class="form-control" name="term" id="term" required>
									<option value="">Select Term</option>	
									<option value="First Term">First</option>							
									<option value="Second Term">Second</option>							
									<option value="Third Term">Third</option>															
								</select>								
							</div>		
						</div>
						<div class="col-sm-3">
							<label for="session_id">Class</label>
							<div class="">
								<select class="form-control" name="class_id" id="class_id" required>
									<option value="">Select Class</option>
									@foreach($cteach as $Key =>$ct)
									<option value="{{ $ct->class_id }}">{{ $ct->class_name }}{{ $ct->section }}</option>
									@endforeach	
									
								</select>								
							</div>	
						</div>
						<div class="col-sm-3">							
							<label for="student_id">Student Reg</label>
							<div class="">
								<input type="text" name="regno" id="regno" class="form-control" placeholder="Registration Number">								
							</div>	
						</div>		
					</div>
				</div>				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm" id="add-student-result">Check Result</button>					
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>			
		</section>						
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">			

			

							
							
						</section>
						
	</div>

				{{---------}}
</div>




@endsection
@section('script')
	<script type="text/javascript">

	// GET STUDENT

	$('#frm-get-result #class_id').on('change',function(e){
			var class_id = $(this).val();
			var student = $('#student_id')
			$(student).empty();
			$.get("{{ route('showStudents') }}",{class_id:class_id},function(data){
				
				$.each(data,function(i,l){

					$(student).append($("<option/>",{
						value : l.student_id,
						text : l.student_name
					}))
				})
			})

		})

		// GET STUDENT

	$('#frm-remark #class').on('change',function(e){
			var class_id = $(this).val();
			var student = $('#student')
			$(student).empty();
			$.get("{{ route('showStudents') }}",{class_id:class_id},function(data){
				
				$.each(data,function(i,l){

					$(student).append($("<option/>",{
						value : l.student_id,
						text : l.student_name
					}))
				})
			})

		})

	</script>

@endsection

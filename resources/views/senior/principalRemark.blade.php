@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Results</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Result</li>
			<li><i class="fa fa-file-text-o"></i>Check Result Add Remark</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading">
				<b>Check Result </b>
			</header>

			<div class="alert alert-success" style="display:none"></div>

			<form action="" class="form-horizontal" id="frm-get-result" method="get">
				@if(Session::has('flash_message_success'))                    
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{!! session('flash_message_success') !!}</strong>
					</div>
				@endif
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="session_id">Year</label>
							<div class="">
								<select class="form-control" name="session_id" id="session_id" required>
									<option value="">Select Year</option>
									@foreach($sessions as $Key =>$ses)
									<option value="{{ $ses->id }}">{{ $ses->year }}</option>
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
									<option value="{{ $ct->id }}">{{ $ct->class_name }}{{ $ct->section }}</option>
									@endforeach	
									
								</select>								
							</div>	
						</div>
						<div class="col-sm-3">							
							<label for="student_id">Student</label>
							<div class="">
								<select class="form-control" name="student_id" id="student_id" required>
									<option value="">Student Name</option>
													
								</select>								
							</div>	
						</div>		
					</div>
				</div>				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm" id="add-student-result">Find Result</button>					
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>			
		</section>						
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">			

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading"><b>Result Information</b>
				</div>
				<div class="panel-body" id="add-class-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>						
								<th>Subject</th>
								<th>Test Score</th>
								<th>Exam Score</th>
								<th>Total</th>
								<th>LTC</th>
								<th>Final Cum.</th>
								<th>Grade</th>
								<th>Remark</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($results as $result)
								<tr>
									<td>{{ $result->subjects->subject_name }}</td>
									<td> {{ $result->test_score }}</td>
									<td> {{ $result->exam_score }}</td>
									<td> {{ $result->total }}</td>
									<td> {{ $result->ltc }}</td>
									<td> {{ $result->final_cum }}</td>
									<td> {{ $result->grade }}</td>
									<td> {{ $result->remarks }}</td>
									<td>Action</td>
								</tr>
							@endforeach
							<tr>
								<td>Total</td>
								<td>{{ $test }}</td>
								<td>{{ $exam }}</td>
								<td>{{ $total }}</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
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
					<b>Class Teacher's Remark: {{ $ctRemark ? $ctRemark->remark : 'No Remark' }}</b><br>
				</div>
			</div>
		</section>						
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading">
				<b>Add Remark</b>
			</header>

			<div class="alert alert-success" style="display:none"></div>
			@if($pRemark)
				<h3 class="text-center">Remark Added Already</h3><br>
			@else
				<form action="{{ url('ss-principalRemark') }}" class="form-horizontal" id="frm-remark" method="post">
					{{ csrf_field() }}
					<div class="panel-body" style="border-bottom: 1px solid #ccc;">
						<div class="form-group">
							<div class="col-sm-3">
								<label for="session_id">Year</label>
								<div class="">
									<select class="form-control" name="session_id" id="session_id" required>
										<option value="{{ $ss ? $ss->id : '' }}">{{ $ss ? $ss->year : '' }}</option>
										<!-- @foreach($sessions as $Key =>$ses)
										<option value="{{ $ses->id }}">{{ $ses->year }}</option>
										@endforeach	 -->
										
									</select>								
								</div>	
							</div>	

							<div class="col-sm-3">
								<label for="term">Term</label>
								<div class="">
									<select class="form-control" name="term" id="term" required>
										<option value="{{ $term }}">{{ $term }}</option>													
									</select>								
								</div>		
							</div>
							<div class="col-sm-3">
								<label for="session_id">Class</label>
								<div class="">
									<select class="form-control" name="class_id" id="class" required>
										<option value="{{ $class ? $class->id : '' }}">{{ $class ? $class->class_name : '' }}{{ $class ? $class->section : '' }}</option>
										<!-- @foreach($cteach as $Key =>$ct)
										<option value="{{ $ct->class_id }}">{{ $ct->class_name }}{{ $ct->section }}</option>
										@endforeach	 -->
										
									</select>								
								</div>	
							</div>
							<div class="col-sm-3">							
								<label for="student_id">Student</label>
								<div class="">
									<select class="form-control" name="student_id" id="student" required>
										<option value="{{ $stud ? $stud->id : '' }}">{{ $stud ? $stud->student_name : '' }}</option>
														
									</select>								
								</div>	
							</div>
							<div class="col-sm-offset-4 col-sm-4">
								<label for="remark">Remark</label>
								<div class="">
									<textarea name="remark" id="remark" cols="40" rows="2"></textarea>						
								</div>	
							</div>
						</div>
					</div>				
					<div class="panel-footer">
						<button type="submit" class="btn btn-success btn-sm" id="add-student-result">Add Remark</button>					
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>	
			@endif		
		</section>						
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript">

	// GET STUDENT

	$('#frm-get-result #class_id').on('change',function(e){
			var class_id = $(this).val();
			var student = $('#student_id')
			$(student).empty();
			$.get("{{ route('ss-showStudents') }}",{class_id:class_id},function(data){
				
				$.each(data,function(i,l){

					$(student).append($("<option/>",{
						value : l.id,
						text : l.student_name
					}))
				})
			})

		})

		// GET STUDENT

	// $('#frm-remark #class').on('change',function(e){
	// 		var class_id = $(this).val();
	// 		var student = $('#student')
	// 		$(student).empty();
	// 		$.get("{{ route('showStudents') }}",{class_id:class_id},function(data){
				
	// 			$.each(data,function(i,l){

	// 				$(student).append($("<option/>",{
	// 					value : l.student_id,
	// 					text : l.student_name
	// 				}))
	// 			})
	// 		})

	// 	})

	</script>

@endsection
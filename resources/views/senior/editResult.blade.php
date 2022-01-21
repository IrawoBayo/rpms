@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Results</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Result</li>
			<li><i class="fa fa-file-text-o"></i>Manage Result</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading">
				<b>Edit Result</b>
			</header>

			<div class="alert alert-success" style="display:none"></div>

			<form action="{{ url('/editResult/'.$result->id) }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						<input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
						<div class="col-sm-4">
							<label for="session_id">Year</label>
							<div class="">
								<select class="form-control" name="session_id" id="session_id">
									<option value="">Select Year</option>
									@foreach($sessions as $Key =>$ses)
									<option value="{{ $ses->id }}">{{ $ses->year }}</option>
									@endforeach	
									
								</select>								
							</div>	
						</div>	

						<div class="col-sm-4">
							<label for="subject_name">Term</label>
							<div class="">
								<select class="form-control" name="term" id="term">
								<option value="">Select Term</option>	
								<option value="First Term">First</option>							
								<option value="Second Term">Second</option>							
								<option value="Third Term">Third</option>															
								</select>
								
							</div>		
						</div>		


						{{--------------}}
						<div class="col-sm-4">
							<label for="subject_code">Subject</label>
							<div class="">
								<select class="form-control" name="subject_id" id="subject_id">

									@foreach($subjects as $Key =>$sub)
									<option value="{{ $sub->subject_id }}">{{ $sub->subjects->subject_name }}</option>
									@endforeach	
									
								</select>
								
							</div>	
						</div>
					</div>				
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-4">
							<label for="class_id">Class</label>
							<div class="">
								<select class="form-control dynamic" name="class_id" id="class_id" data-dependent="class_id">
								<option value="">Select Class</option>

									@foreach($myclass as $Key =>$c)
									<option value="{{ $c->class_id }}">{{ $c->class_name }}{{ $c->section }}</option>
									@endforeach	
									
								</select>
								
							</div>		
						</div>						

						<div class="col-sm-4">							
							<label for="student_id">Student</label>
							<div class="">
								<select class="form-control" name="student_id" id="student_id">
									<option value="">Student Name</option>									
								</select>								
							</div>	
						</div>
					</div>				
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-2">
							<label for="test_score">Test Score</label>
							<div class="form-group">
								<input type="number" max="40" id="test_score" name="test_score">								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="exam_score">Exam Score</label>
							<div class="form-group">
								<input type="number" max="60" id="exam_score" name="exam_score">								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="total">Total Score</label>
							<div class="form-group">
								<input type="number" id="total" name="total">								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="grade">Grade</label>
							<div class="form-group">
								<input type="text" id="grade" name="grade">								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="remarks">Remark</label>
							<div class="form-group">
								<input type="text" id="remarks" name="remarks">	
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm" id="add-student-result">Update Result</button>
					
				</div>
			</form>
			
		</section>
						
	</div>

				{{---------}}
</div>


@endsection

@section('script')
	<script type="text/javascript">

	// GET STUDENT

	$('#frm-create-subject #class_id').on('change',function(e){
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



   //////////////////////////////////////

   $(function() {

		$('#test_score, #exam_score').keyup(function(){
		updateTotal(); 
		});

		var updateTotal = function () {
			var input1 = parseInt($('#test_score').val());
			var input2 = parseInt($('#exam_score').val());
			if (isNaN(input1) || isNaN(input2)) {
				if(!input2){
					$('#total').val($('#test_score').val());
				}

				if(!input1){
						$('#total').val($('#exam_score').val());
				}

			} else { 
					var total = input1 + input2;
					if (total <= 39) {
						$('#total').val(total);
						$('#grade').val('F');
						$('#remarks').val('Fail');
					}
					else if (total >= 40 && total <=44){
						$('#total').val(total);
						$('#grade').val('E8');
						$('#remarks').val('Pass');
					}
					else if (total >= 45 && total <=49){
						$('#total').val(total);
						$('#grade').val('D7');
						$('#remarks').val('Pass');
					}
					else if(total >= 50 && total <=54){
						$('#total').val(total);
						$('#grade').val('C6');
						$('#remarks').val('Credit');
					} 
					else if(total >= 55 && total <=59){
						$('#total').val(total);
						$('#grade').val('C5');
						$('#remarks').val('Credit');
					} 
					else if(total >= 60 && total <=64){
						$('#total').val(total);
						$('#grade').val('C4');
						$('#remarks').val('Credit');
					} 
					else if(total >= 65 && total <=69){
						$('#total').val(total);
						$('#grade').val('B3');
						$('#remarks').val('Good');
					} 
					else if(total >= 70 && total <= 74){
						$('#total').val(total);
						$('#grade').val('B2');
						$('#remarks').val('Very Good');
					}
					else {
						$('#total').val(total);
						$('#grade').val('A');			
						$('#remarks').val('Excellent');
					}            
					
			}

		};

	});

	//========================================

	// $('#frm-create-subject').on("submit",function(e){
	// 	e.preventDefault();
	// 	var data = $(this).serialize();
	// 	var url = $(this).attr('action');
	// 	$.post(url,data,function(data){
	// 		// alert("Result Added");
	// 		jQuery('.alert').show();
    //                  jQuery('.alert').html(data.success);
	// 	})
	// })


	/////////////////////////////////////////////////////

	///// Read Result ////////

	// $('#add-student-result').on('click', function(){
	// 	$.get("{{ URL::to('manageResult') }}", function(data){
	// 		$('#result-info').empty().html(data);
			
	// 	})
	// })
    
    </script>
@endsection
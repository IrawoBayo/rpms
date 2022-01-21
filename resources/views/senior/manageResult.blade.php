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
				<b>Add Result</b>
			</header>

			<div class="alert alert-success" style="display:none"></div>

			<form action="{{ route('ss-manageResult') }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				@if(Session::has('flash_message_success'))                    
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
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
								<select class="form-control dynamic" name="class_id" id="class_id" data-dependent="student_id">
								<option value="">Select Class</option>

									@foreach($myclass as $Key =>$c)
									<option value="{{ $c->id }}">{{ $c->class_name }}{{ $c->section }}</option>
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
							<!--<label for="grade">Grade</label>-->
							<div class="form-group">
								<input type="hidden" id="grade" name="grade">								
							</div>		
						</div>

						<div class="col-sm-2">
							<!--<label for="remarks">Remark</label>-->
							<div class="form-group">
								<input type="hidden" id="remarks" name="remarks">	
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm">Add Result</button>
					
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
			
		</section>
						
	</div>

				{{---------}}
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">			

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading">
					<b>Result Information</b>
					<!-- <button id="view-result" class="btn-success pull-right">View Results</button> -->
				</div>
				<div class="panel-body" id="add-class-body">
					@if(Session::has('flash_message_danger'))                    
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
							<strong>{!! session('flash_message_danger') !!}</strong>
						</div>
					@endif
					<table class="table table-bordered table-striped" id="myTable">
						<thead>
							<tr>
								<th>Class</th>
								<th>Subject</th>
								<th>Name</th>
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
						<tbody id="result-info">
							@foreach($results as $result)
								<tr>
									<td>{{ $result->classes->class_name }}{{ $result->classes->section }}</td>
									<td> {{ $result->subjects->subject_name }}</td>
									<td> {{ $result->students->student_name }}</td>
									<td> {{ $result->test_score }}</td>
									<td> {{ $result->exam_score }}</td>
									<td> {{ $result->total }}</td>
									<td> {{ $result->ltc }}</td>
									<td> {{ $result->final_cum }}</td>
									<td> {{ $result->grade }}</td>
									<td> {{ $result->remarks }}</td>
									<td>
										<!-- <a href="{{ url('/editResult/'.$result->id) }}"><button class="btn btn-info">Edit</button></a> -->
										<a href="{{ url('/ss-deleteResult/'.$result->id) }}"><button onclick="return confirm('Are you sure you want to delete this result?')" class="btn btn-danger">Delete</button></a>
									</td>
								</tr>

							@endforeach
						</tbody>
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

	// GET STUDENT

	$('#frm-create-subject #class_id').on('change',function(e){
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

	$('#view-result').on('click', function(){
		$.get("{{ URL::to('manageResult') }}", function(data){
			$('#result-info').empty().html(data);
			// console.log(data);

			// $.each(data, function(i, value){
			// 	var tr = $("<tr/>");
			// 		tr.append($("<td/>",{
			// 			text : value.subject_id
			// 		}))
			// 	$('#result-info').append(tr);
			// });
		})
	})
    
    </script>
@endsection
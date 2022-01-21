@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Subjects</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Subject</li>
			<li><i class="fa fa-file-text-o"></i>Manage Subject</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading">
				<b>Manage Subject</b>
			</header>

			<form action="{{ route('pri-manageSubject') }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				@if(Session::has('flash_message_success'))                    
                	<div class="alert-success">
                    	 <button type="button" class="close" data-dismiss="alert">×</button> 
                         {!! session('flash_message_success') !!}
                   </div>
                @endif
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						

						<div class="col-sm-2">
							<label for="subject_name">Subject Name</label>
							<div class="input-group">
								<input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="Subject Name">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="subject_code">Subject Code</label>
							<div class="input-group">
								<input type="text" name="subject_code" id="subject_code" class="form-control" placeholder="Subject Code">
								
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">Create Subject</button>
				</div>
			
			</form>

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading"><b>Subject Information</b>
				</div>
				<div class="panel-body" id="add-class-body">
					@if(Session::has('flash_message_danger'))                    
	                	<div class="alert-danger">
	                    	 <button type="button" class="close" data-dismiss="alert">×</button> 
	                         {!! session('flash_message_danger') !!}
	                   </div>
	                @endif

					<table class="table table-stripped" id="myTable" width="80%">
						<thead>
							<tr>
								<th>>Subject</th>
								<th>>Subject Code</th>
								<th>Action</th>
							</tr>
						</thead>
						@foreach($subjects as $subject)
							<tbody>
								<tr>
									<td>{{$subject->subject_name}}</td>
									<td>{{$subject->subject_code}}</td>
									<td>
										<a href="{{ url('/pri-editSubject/'.$subject->id) }}"><button class="btn btn-info">Edit</button></a>
										<a href="{{ url('/pri-deleteSubject/'.$subject->id) }}"><button onclick="return confirm('Are you sure you want to delete this Subject?')" class="btn btn-danger">Delete</button></a>
									</td>
								</tr>
							</tbody>
						@endforeach
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
		// $('#start_date').datepicker({
		// 	changeMonth:true,
		// 	changeYear:true,
		// 	dateFormat:'dd-mm-dd'
		// });

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
@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Classes</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Class</li>
			<li><i class="fa fa-file-text-o"></i>Manage Class</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading">
				<b>Manage Class</b>
			</header>

			<form action="{{ route('ss-manageClass') }}" class="form-horizontal" id="frm-create-subject" method="POST">
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
							<label for="class_name">Class Name</label>
							<div class="input-group">
								<input type="text" name="class_name" id="class_name" class="form-control" placeholder="SS 1">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="section">Class Section</label>
							<div class="input-group">
								<input type="text" name="section" id="section" class="form-control" placeholder="A, B, C, D">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="class_name_num">Class Code</label>
							<div class="input-group">
								<input type="text" name="class_name_num" id="class_name_num" class="form-control" placeholder="Science">
								
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">Create Class</button>
				</div>
				
			</form>

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading"><b>Class Information</b>
				</div>
				<div class="panel-body" id="add-class-body">
					@if(Session::has('flash_message_danger'))                    
	                	<div class="alert-danger">
	                    	 <button type="button" class="close" data-dismiss="alert">×</button> 
	                         {!! session('flash_message_danger') !!}
	                   </div>
	                @endif
					@if($classes)
						<table class="table table-stripped" id="myTable"> 
							<thead>
								<tr>
									<th>Class Name</th>
									<th>Section</th>
									<th>Class Code</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($classes as $class)
									<tr>
										<td>{{ $class->class_name }}</td>
										<td>{{ $class->section }}</td>
										<td>{{ $class->class_name_num }}</td>
										<td>
											<a href="{{ url('/ss-editClass/'.$class->id) }}"><button class="btn btn-info">Edit</button></a>
											<a href="{{ url('/ss-deleteClass/'.$class->id) }}"><button onclick="return confirm('Are you sure you want to delete this Class?')" class="btn btn-danger">Delete</button></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
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
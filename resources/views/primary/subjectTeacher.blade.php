@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Classes</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Assign</li>
			<li><i class="fa fa-file-text-o"></i>Subject Teacher</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading">
				<b>Assign Subject Teacher</b>
			</header>

			<form action="{{ route('pri-subjectTeacher') }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				@if(Session::has('flash_message_success'))                    
					<div class="alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{!! session('flash_message_success') !!}</strong>
					</div>
				@endif
				
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group col-sm-12">								

						<div class="col-sm-4">
							<label for="class_name">Subject</label>
							<div class="">
								<select class="form-control" name="subject_id[]" id="subject_id">
									<option value="">Select Subject</option>

									@foreach($subjects as $Key =>$c)
									<option value="{{ $c->id }}">{{ $c->subject_name }}</option>
									@endforeach	
										
								</select>											
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-4">
							<label for="section">Teacher</label>
							<div class="">
								<select class="form-control" name="user_id[]" id="user_id">
									<option value="">Select Teacher</option>

									@foreach($teachers as $Key =>$t)
										@if($t->active==1)
											<option value="{{ $t->id }}">{{ $t->name }}</option>
										@endif
									@endforeach	
										
								</select>												
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="section">More</label>
							<div>
								<button class="btn btn-success" type="button"  onclick="service_fields();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>	
							</div>				
						</div>					
					</div>

					<div id="service_fields"></div> 
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">Create</button>
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
					@if($subjectteachers)
						<table class="table table-stripped" id="myTable">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Subject Teacher</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($subjectteachers as $st)
									@if($st->user->active==1)
										<tr>
											<td>{{ $st->subjects->subject_name }}</td>
											<td>{{ $st->user->name }}</td>
											<td>
												<a href="{{ url('/pri-editST/'.$st->id) }}"><button class="btn btn-info">Edit</button></a>
												<a href="{{ url('/pri-deleteST/'.$st->id) }}"><button onclick="return confirm('Are you sure you want to delete this Subject Teacher?')" class="btn btn-danger">Delete</button></a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
			</div>
		</section>
						
	</div>

				{{---------}}
</div>

@endsection

@section('script')
<script type="text/javascript">
	var room = 1;
	function service_fields() {	
		room++;
		var objTo = document.getElementById('service_fields')
		var divtest = document.createElement("div");
		divtest.setAttribute("class", "form-group removeclass"+room);
		var rdiv = 'removeclass'+room;
		divtest.innerHTML = '<div class="form-group col-sm-12"><div class="col-sm-4"><div class=""><select class="form-control" name="subject_id[]" id="subject_id"><option value="">Select Subject</option>@foreach($subjects as $Key =>$c)<option value="{{ $c->id }}">{{ $c->subject_name }}</option>@endforeach</select></div></div><div class="col-sm-4"><div class=""><select class="form-control" name="user_id[]" id="user_id"><option value="">Select Teacher</option>@foreach($teachers as $Key =>$t)<option value="{{ $t->id }}">{{ $t->name }}</option>@endforeach</select></div></div><div class="col-sm-2"><div><button class="btn btn-danger" type="button"  onclick="remove_service_fields('+ room +');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></div></div></div>';
		
		objTo.appendChild(divtest)
	}
   function remove_service_fields(rid) {
	   $('.removeclass'+rid).remove();
   }
   </script>

@endsection
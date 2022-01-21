@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Results</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Prinvipal Approval</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading">
				<b>View Result</b>
			</header>

			<div class="alert alert-success" style="display:none"></div>
			@if($check > 0)
				<form action="{{ route('ss-principalApproval') }}" class="form-horizontal" id="frm-get-result" method="post">
					{{ csrf_field() }}
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
										@foreach($sessions as $session)
											<option value="{{ $session->id }}">{{ $session->year }}</option>
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
								<label for="term">Class</label>
								<div class="">
									<select class="form-control" name="class_id" id="class_id" required>
										<option value="">Select Class</option>
										@foreach($classes as $class)
											<option value="{{ $class->id }}">{{ $class->class_name }}{{ $class->section }}</option>
										@endforeach
									</select>								
								</div>		
							</div>
							<div class="col-sm-3">
								<label for="term">Action</label>
								<div>
									<button type="submit" class="btn btn-success" id="approve-result">Approve Result</button>
								</div>
							</div>				
						</div>
					</div>				
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			@else
				<h3 class="text-center">There is no result to approve</h3><br>
			@endif
		</section>						
	</div>
</div>



@endsection

@section('script')

@endsection
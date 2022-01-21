@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Results</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Approve Result</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading">
				<b>Approve Result - FOR CLASS TEACHERS</b>
			</header>

			<div class="alert alert-success" style="display:none"></div>
			@if($check > 0)
				<form action="{{ route('pri-teacherApproval') }}" class="form-horizontal" id="frm-get-result" method="get">
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
							<input type="hidden" name="class_id" id="class_id" value="{{ $cteach->class_id }}">	
						</div>
					</div>				
					<div class="panel-footer">
						<button type="submit" class="btn btn-info btn-sm" id="add-student-result">Approve Result</button>					
					</div>
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
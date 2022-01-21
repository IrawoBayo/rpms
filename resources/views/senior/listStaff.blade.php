@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Staff</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Staff</li>
			<li><i class="fa fa-file-text-o"></i>Manage Staff</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Staff List</b></div>
			<div class="panel-body" id="add-class-body">
				@if(Session::has('flash_message_success'))                    
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						{!! session('flash_message_success') !!}
					</div>
				@endif
				@if(Session::has('flash_message_danger'))                    
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						{!! session('flash_message_danger') !!}
					</div>
				@endif
				@if($staffs)
					<table class="table table-stripped" id="myTable">
						<thead>
							<tr>
								<th>Full Name</th>
								<th>Email</th>
								<th>Phone No.</th>
								<th>Username</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach($staffs as $staff)
								@if($staff->active==1)
									<tr>
										<td>{{ $staff->name }}</td>
										<td>{{ $staff->email }}</td>
										<td>{{ $staff->staff_phone_number }}</td>
										<td>{{ $staff->username }}</td>
										<td>{{ $staff->roles->name }}</td>
										<td>
											@if($staff->active==1)
												<div style="color: green;">Enabled</div>
											@else
												<div style="color: red;">Disabled</span></div>
											@endif
										</td>
										<td>
											<a href="{{ url('/ss-editStaff/'.$staff->id) }}"><button class="btn btn-info">Edit</button></a>
											<a href="{{ url('/ss-deleteStaff/'.$staff->id) }}"><button onclick="return confirm('Are you sure you want to delete this staff?')" class="btn btn-danger">Delete</button></a>
											@if($staff->active==1)
												<a href="{{ route('sschangestatus', $staff->id) }}"><button onclick="return confirm('Are you sure you want to DISABLE this staff?')" class="btn btn-warning">Disable</button></a>
											@else
												<a href="{{ route('sschangestatus', $staff->id) }}"><button onclick="return confirm('Are you sure you want to ENABLE this staff?')" class="btn btn-success">Enable</button></a>
											@endif
											
										</td>
									</tr>
								@endif
							@endforeach
						
						</tbody>
					</table>
				@endif
			</div>
		</div>	
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript">


	</script>

@endsection
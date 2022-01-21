@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Staffs</b></h3>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="#">Home</a></li>
			<li><i class="icon_document_alt"></i>Staff</li>
			<li><i class="fa fa-file-text-o"></i>Manage Staff</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">
			<header class="panel-heading">
				<b>Edit Staff</b>
			</header>

			<form action="{{ url('/editStaff/'.$staff->id) }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}

				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						

						<div class="col-sm-2">
							<label for="staff_id_num">Staff ID Number</label>
							<div class="input-group">
								<input type="text" name="staff_id_num" id="staff_id_num" class="form-control" value="{{ $staff->staff_id_num }}">
								
							</div>		
						</div>

						{{----------------------}}

						<div class="col-sm-2">
							<label for="role_id">Role</label>
							<div class="input-group">
								<select class="form-control" name="role_id" id="role_id">
								<option value="">Select Role</option>

								@foreach($roles as $Key =>$s)
									<option value="{{ $s->id }}" @if($s->id == $staff->role_id) selected @endif>{{ $s->name }}</option>
									@endforeach
								</select>
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="name">Staff Fullname</label>
							<div class="input-group">
								<input type="text" name="name" id="name" class="form-control" value="{{ $staff->name }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="email">Staff Email</label>
							<div class="input-group">
								<input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="staff_phone_number">Phone Number</label>
							<div class="input-group">
								<input type="text" name="staff_phone_number" id="staff_phone_number" class="form-control" value="{{ $staff->staff_phone_number }}"">
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="active">Status</label>
							<div class="input-group">
								<select class="form-control" name="active" id="active">
									<option value="1">Enable Staff</option>
									<option value="0">Disable Staff</option>
									
								</select>
								
							</div>		
						</div>

						<div class="col-sm-2">
							<label for="username">Username</label>
							<div class="input-group">
								<input type="text" name="username" id="username" class="form-control" value="{{ $staff->username }}">
								
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm">Update Staff</button>
				</div>
			</form>
			
		</section>	
	</div>

				{{---------}}
</div>

@endsection


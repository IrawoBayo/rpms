@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Class</b></h3>
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
				<b>Edit Class</b>
			</header>

			<form action="{{ url('/pri-editClass/'.$class->id) }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}

				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">

						<div class="col-sm-2">
							<label for="class_name">Class Name</label>
							<div class="input-group">
								<input type="text" name="class_name" id="class_name" class="form-control" value="{{ $class->class_name }}">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="section">Class Section</label>
							<div class="input-group">
								<input type="text" name="section" id="section" class="form-control" value="{{ $class->section }}">
								
							</div>		
						</div>


						{{--------------}}
						<!-- <div class="col-sm-2">
							<label for="class_name_num">Class Code</label>
							<div class="input-group">
								<input type="text" name="class_name_num" id="class_name_num" class="form-control" placeholder="1A, 2B, 3C">
								
							</div>		
						</div> -->
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


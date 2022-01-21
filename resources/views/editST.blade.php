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
				<b>Edit Subject Teacher</b>
			</header>

			<form action="{{ url('/editST/'.$st->id) }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group col-sm-12">								

						<div class="col-sm-4">
							<label for="class_name">Subject</label>
							<div class="">
								<select class="form-control" name="subject_id" id="subject_id">
									<option value="">Select Subject</option>

									@foreach($subjects as $Key =>$c)
									<option value="{{ $c->subject_id }}" @if($c->subject_id  == $st->subject_id) selected @endif>{{ $c->subject_name }}</option>
									@endforeach	
										
								</select>											
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-4">
							<label for="section">Teacher</label>
							<div class="">
								<select class="form-control" name="user_id" id="user_id">
									<option value="">Select Teacher</option>

									@foreach($teachers as $Key =>$t)
									<option value="{{ $t->id }}" @if($t->id  == $st->user_id) selected @endif>{{ $t->name }}</option>
									@endforeach	
										
								</select>												
							</div>		
						</div>			
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
				
			</form>
		</section>
						
	</div>

				{{---------}}
</div>

@endsection

@section('script')
<script type="text/javascript">
	
   </script>

@endsection
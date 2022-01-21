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
				<b>Edit Subject</b>
			</header>

			<form action="{{ url('/pri-editSubject/'.$subject->id) }}" class="form-horizontal" id="frm-create-subject" method="POST">
				{{ csrf_field() }}
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						

						<div class="col-sm-2">
							<label for="subject_name">Subject Name</label>
							<div class="input-group">
								<input type="text" name="subject_name" id="subject_name" class="form-control" value="{{ $subject->subject_name }}">
								
							</div>		
						</div>


						{{--------------}}
						<div class="col-sm-2">
							<label for="subject_code">Subject Code</label>
							<div class="input-group">
								<input type="text" name="subject_code" id="subject_code" class="form-control" value="{{ $subject->subject_code }}">
								
							</div>		
						</div>
					</div>
				</div>
				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success">Update Subject</button>
				</div>
			
			</form>
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
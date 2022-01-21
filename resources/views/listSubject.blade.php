@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Subjects</b></h3>
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

			{{----------------------------}}

			<div class="panel panel-default">
				<div class="panel-heading"><b>Subject Information</b>
				</div>
				<div class="panel-body" id="add-class-body">

					
						<table style="width:100%">


						<tr>
							
						<th style="border: 1px;"><h3 style="font-family: sans-serif";>Subject</h2></th>
						<th colspan="2"><h3 style="font-family: sans-serif";>Subject Code</h2></th>
						</tr>




					@foreach($subjects as $subject)



						<tr>

						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$subject->subject_name}}</h4></td>
						<td style="width: 10%"><h4 style="font-family: sans-serif";>{{$subject->subject_code}}</h4></td>
						
						</tr>
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


		

	</script>

@endsection
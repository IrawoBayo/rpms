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
								<b>Manage Subject</b>
							</header>

							<form action="{{ route('subjectComb') }}" class="form-horizontal" id="frm-create-subject" method="POST">

								{{ csrf_field() }}
								
								<div class="panel-body" style="border-bottom: 1px solid #ccc;">
									<div class="form-group">
										

										<div class="col-sm-2">
											<label for="class_id">Class</label>
											<div class="input-group">
												<select class="form-control" name="class_id" id="class_id">
												<option value="">Select Class</option>

												@foreach($myClass as $Key =>$c)
													<option value="{{ $c->class_id }}">{{ $c->class_name }}</option>
													@endforeach	

													
													
												</select>
												
											</div>		
										</div>


										{{--------------}}
										<div class="col-sm-2">
											<label for="subject_code">Subject</label>
											<div class="input-group">
												<select class="form-control" name="subject_id" id="subject_id">
												<option value="">Select Subject</option>

													@foreach($subjects as $Key =>$s)
													<option value="{{ $s->subject_id }}">{{ $s->subject_name }}</option>
													@endforeach	
													
												</select>
												
											</div>		
										</div>


										


									</div>
								</div>
								
								<div class="panel-footer">
									<button type="submit" class="btn btn-success btn-sm">Create Subject</button>
								</div>
								
							</form>

							{{----------------------------}}

							<div class="panel panel-default">
								<div class="panel-heading"><b>Subject Combination Information</b>
								</div>
								<div class="panel-body" id="add-class-body">

									 <table style="width:100%">


									 	<tr>
									 		
									    <th style="width: 40%;"><h3 style="font-family: sans-serif";>Subject Name</h2></th>

									    	<th style="width: 30%;"><h3 style="font-family: sans-serif";>Class Name</h2></th>

									    <th style="width: 30%;"><h3 style="font-family: sans-serif";>Section</h2></th>

									 </tr>




									@foreach($subjectcombinations as $subjectcombination)


    
									  <tr>

									  	<td style="width: 40%;"><h4 style="font-family: sans-serif";>{{$subjectcombination->subjectcombination_id}}</h4></td>
									  	
									    <td style="width: 40%;"><h4 style="font-family: sans-serif";>{{$subjectcombination->subject_id}}</h4></td>
									    
									    <td style="width: 30%"><h4 style="font-family: sans-serif";>{{$subjectcombination->class_id}}</h4></td>
									    
									  </tr>
									  @endforeach
									</table>


								</div>


								
							</div>

							{{-----------------------------}}
							
						</section>
							
						</section>
						
	</div>

				{{---------}}
</div>












@endsection

@section('script')
	<script type="text/javascript">

		
		

	</script>

@endsection
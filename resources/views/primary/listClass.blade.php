@extends('layouts.master')
@section('content')


<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-text-o"></i><b>Classes</b></h3>
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

									<table style="width:100%;">


									 	<tr>
									 		
									 	<th style="width: 30%;"><h3 style="font-family: sans-serif;">Class Name</h2></th>

									 		<th style="width: 30%;"><h3 style="font-family: sans-serif";>Section</h2></th>


									    <th style="width: 40%;"><h3 style="font-family: sans-serif;">Class Name Code</h2></th>
									    
									 </tr>




									@foreach($classes as $class)


    
									  <tr>

									    <td style="width: 30%;"><h4 style="font-family: sans-serif";>{{$class->class_name}}</h4></td>

									    <td style="width: 20%;"><h4 style="font-family: sans-serif;">{{$class->section}}</h4></td>


									    <td style="width: 40%;"><h4 style="font-family: sans-serif;">{{$class->class_name_num}}</h4></td>
									    
									    
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
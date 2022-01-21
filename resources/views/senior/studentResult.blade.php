<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Dashboard</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <!-- bootstrap theme -->

  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}">
  <!--external css-->
  <!-- font icon -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/elegant-icons-style.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
  <!-- full calendar css-->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('assets/fullcalendar/fullcalendar/fullcalendar.css')}}">
  <!-- easy pie chart-->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}">

  <!-- owl carousel -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}">


  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-jvectormap-1.2.2.css')}}">
  <!-- Custom styles -->

  <link rel="stylesheet" type="text/css" href="{{asset('css/fullcalendar.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/widgets.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/style-responsive.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/xcharts.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui-1.10.4.min.')}}">
  
</head>


<body>
	  <!-- container section start -->
  <section id="container" class="">
  	@include('layouts.resultHeader.header')
  	
  	<!--main content start-->
    <section id="main-content">
      <div class="wrapper">

        @yield('content')
        
      </div>


    </section>
  	


    
<section id="container" class="" style="overflow-y: auto; height: 700px;">

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">


            <div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class=""></i><b><h3 class="text-center text-capitalize text-bold" style="color: white;">
                Welcome to RESULT CHECKER Page<img alt="" src="img/logout-logo.jpg">

            </h3></b></h3>
		
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
						<section class="panel panel-default">

<div class="row">
	<div class="col-lg-12">
	<section class="panel panel-default">
			<header class="panel-heading" align="text-center">
				<div align="right">

                  <b><a href="\">Home</a></b>

                  </div>
				<b>Check Result - FOR STUDENTS</b>
								
			</header>

			<div class="alert alert-success" style="display:none"></div>

			<form action="{{url('/ss-getStudentResult')}}" class="form-horizontal" id="frm-get-result" method="get">
				<div class="panel-body" style="border-bottom: 1px solid #ccc;">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="session_id">Year</label>
							<div class="">
								<select class="form-control" name="session_id" id="session_id" required>
									<option value="">Select Year</option>
									@foreach($sessions as $Key =>$s)
									<option value="{{ $s->id }}">{{ $s->year }}</option>
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
							<label for="session_id">Class</label>
							<div class="">
								<select class="form-control" name="class_id" id="class_id" required>
									<option value="">Select Class</option>
									@foreach($cteach as $Key =>$ct)
									<option value="{{ $ct->id }}">{{ $ct->class_name }}{{ $ct->section }}</option>
									@endforeach	
									
								</select>								
							</div>	
						</div>
						<div class="col-sm-3">							
							<label for="student_id">Student Reg</label>
							<div class="">
								<input type="text" name="regno" id="regno" class="form-control" placeholder="Registration Number">								
							</div>	
						</div>		
					</div>
				</div>				
				<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-sm" id="add-student-result">Check Result</button>					
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>			
		</section>						
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<section class="panel panel-default">			

			

							
							
						</section>
						
	</div>

				{{---------}}
</div>




	  

  <!-- javascripts -->
  <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script
  <script type="text/javascript" src="{{asset('js/jquery-ui-1.10.4.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery-ui-1.9.2.custom.min.js')}}"></script>
  <!-- bootstrap -->
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- nice scroll -->
  <script type="text/javascript" src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.nicescroll.js')}}"></script>
  <!-- charts scripts -->
  <script type="text/javascript" src="{{asset('assets/jquery-knob/js/jquery.knob.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.sparkline.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/owl.carousel.js')}}"></script>
  <!-- jQuery full calendar -->
  <script type="text/javascript" src="{{asset('js/fullcalendar.min.js')}}"></script>
  <!-- Full Google Calendar - Calendar -->
  <script type="text/javascript" src="{{asset('assets/fullcalendar/fullcalendar/fullcalendar.js')}}"></script>
  <!--script for this page only-->

    <script type="text/javascript" src="{{asset('js/calendar-custom.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jquery.rateit.min.js')}}"></script>
    <!-- custom select -->

    <script type="text/javascript" src="{{asset('js/jquery.customSelect.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/chart-master/Chart.js')}}"></script>

    <!--custome script for all page-->
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
    <!-- custom script for this page-->

    <script type="text/javascript" src="{{asset('js/sparkline-chart.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/easy-pie-chart.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/xcharts.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.autosize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.placeholder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/gdp-data.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/morris.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sparklines.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/charts.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.slimscroll.min.js')}}"></script>








    <script type="text/javascript" src="{{asset('js/pdf/jquery-2.1.3.js')}}"></script>


    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.addimage.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.autoprint.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.cell.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.ie_below_9_shim.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.javascript.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.sillysvgrenderer.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.from_html.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.split_text_to_size.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.standard_fonts_metrics.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.plugin.total_pages.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/pdf/jspdf.PLUGINTEMPLATE.js')}}"></script>
	<script type="text/javascript">

	// GET STUDENT

	$('#frm-get-result #class_id').on('change',function(e){
			var class_id = $(this).val();
			var student = $('#student_id')
			$(student).empty();
			$.get("{{ route('showStudents') }}",{class_id:class_id},function(data){
				
				$.each(data,function(i,l){

					$(student).append($("<option/>",{
						value : l.student_id,
						text : l.student_name
					}))
				})
			})

		})

		// GET STUDENT

	$('#frm-remark #class').on('change',function(e){
			var class_id = $(this).val();
			var student = $('#student')
			$(student).empty();
			$.get("{{ route('showStudents') }}",{class_id:class_id},function(data){
				
				$.each(data,function(i,l){

					$(student).append($("<option/>",{
						value : l.student_id,
						text : l.student_name
					}))
				})
			})

		})

	</script>


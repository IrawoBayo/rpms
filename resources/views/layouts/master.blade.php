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

  <title>RP/SIS</title>

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

  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui-1.10.4.min.css')}}">
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
</head>


<body>
	  <!-- container section start -->
  <section id="container" class="">
  	@include('layouts.header.header')
  	@include('layouts.sidebars.sidebar')
  	<!--main content start-->
    <section id="main-content">
      <div class="wrapper">

        @yield('content')

        
      </div>


    </section>


  </section>


	  

  <!-- javascripts -->
  <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    

    @yield('script')


    <script>
$(document).ready(function(){
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
});



      //knob
      $(function() {
        $(".knob").knob({
          'draw': function () {
            $(this.i).val(this.cv + '%')
          }
        });
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });

      // DataTable
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );

    </script>

</body>
</html>
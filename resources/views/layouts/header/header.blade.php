    <header class="header dark-bg" style="background-color: #0088cc;">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="\" class="logo" style="color: white;"><b>RP/ SIS</b></span></a>
      <!--logo end-->

      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
          
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <!-- <span class="profile-ava">
                                <img alt="" src="img/logout-logo.jpg">
                            </span> -->
                            <span class="username"><b>{{ Auth::user()->name }}</b></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="{{ url('/change-password') }}"><i class="icon_profile"></i> Change Password</a>
                </li>

              <li>
              
                <a href="{{ route('logout') }}"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->
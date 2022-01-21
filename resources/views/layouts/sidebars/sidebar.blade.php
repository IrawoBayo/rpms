<!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        @if(Auth::user()->role_id == 1)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                  <i class="icon_house_alt"></i>
                  <span>Dashboard</span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_documents_alt"></i>
                            <span>Staff</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('manageStaff')}}">Manage Staff</a></li>
                <li><a class="" href="{{route('listStaff')}}"><span>Active Staff</span></a></li>
                <li><a class="" href="{{route('inactiveStaff')}}"><span>Inactive Staff</span></a></li>
                
              </ul>
            </li>
            
            <li><a class="" href="{{route('manageClass')}}"><i class="icon_house"></i>
              <span>Classes</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Students</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('manageStudent')}}">Manage Student</a></li>
                <li><a class="" href="{{route('listStudent')}}">View Students</a></li>
              </ul>
            </li>

            <li>
              <a href="{{ route('manageSubject') }}" class="#">
                    <i class="icon_document_alt"></i>
                    <span>Subjects</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_desktop"></i>
                            <span>Assign</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('classTeacher')}}">Class Teacher</a></li>
                <li><a class="" href="{{route('subjectTeacher')}}">Subject Teacher</a></li>
              </ul>
            </li>
            
            <li><a class="" href="{{route('manageSession')}}"><i class="icon_house"></i>
              <span>Sessions</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('promoteStudent')}}"><i class="icon_house"></i>
              <span>Promotion</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('listGraduates')}}"><i class="icon_house"></i>
              <span>Graduate List</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('adminStudentResult')}}"><i class="icon_house"></i>
              <span>Student Result</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            


          </ul>
        @elseif(Auth::user()->role_id == 2)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}"><i class="icon_house_alt"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <li><a class="" href="{{route('manageResult')}}"><i class="icon_book"></i>
                <span>Input Result</span></a></li> 

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Class Teacher</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('checkResult')}}">Add Remark</a></li> 
                <li><a class="" href="{{route('classResult')}}">Approve Result</a></li>
              </ul>
            </li>

          </ul>
        @elseif(Auth::user()->role_id == 3)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                  <i class="icon_house_alt"></i>
                  <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a class="" href="{{route('principalRemark')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Add Remark</a>
            </li>
            <li>
              <a class="" href="{{route('principalApproval')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Approve Result</a>
            </li>
          </ul>
        @elseif(Auth::user()->role_id == 4)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                            <i class="icon_house_alt"></i>
                            <span>Dashboard</span>
                        </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_documents_alt"></i>
                            <span>Staffs</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('pri-manageStaff')}}">Manage Staff</a></li>
                <li><a class="" href="{{route('pri-listStaff')}}"><span>Active Staff</span></a></li>
                <li><a class="" href="{{route('pri-inactiveStaff')}}"><span>Inactive Staff</span></a></li>
                
              </ul>
            </li>
            
            <li>
              <a href="{{route('pri-manageClass')}}" class="">
                  <i class="icon_house"></i>
                  <span>Classes</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Students</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('pri-manageStudent')}}">Manage Student</a></li>
                <li><a class="" href="{{route('pri-listStudent')}}">View Students</a></li>
              </ul>
            </li>

            <li>
              <a href="{{ route('pri-manageSubject') }}" class="">
                  <i class="icon_document_alt"></i>
                  <span>Subjects</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_desktop"></i>
                            <span>Assign</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('pri-classTeacher')}}">Class Teacher</a></li>
                <li><a class="" href="{{route('pri-subjectTeacher')}}">Subject Teacher</a></li>
              </ul>
            </li>
            
            <li><a class="" href="{{url('pri-promoteStudent')}}"><i class="icon_house"></i>
              <span>Promotion</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('pri-listGraduates')}}"><i class="icon_house"></i>
              <span>Graduate List</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('pri-adminStudentResult')}}"><i class="icon_house"></i>
              <span>Student Result</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
          </ul>
        @elseif(Auth::user()->role_id == 5)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}"><i class="icon_house_alt"></i>
                <span>Dashboard</span>
              </a>

            </li><li><a class="" href="{{route('pri-manageResult')}}"><i class="icon_book"></i>
                <span>Input Result</span></a></li> 

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Class Teacher</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">            
                <li><a class="" href="{{route('pri-checkResult')}}">Add Remark</a></li> 
                <li><a class="" href="{{route('pri-classResult')}}">Approve Result</a></li>
              </ul>
            </li>

          </ul>
        @elseif(Auth::user()->role_id == 6)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                  <i class="icon_house_alt"></i>
                  <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a class="" href="{{route('pri-principalRemark')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Add Remark</a>
            </li>       
            <li>
              <a class="" href="{{route('pri-principalApproval')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Approve Result</a></li>
          </ul>
          @elseif(Auth::user()->role_id == 7)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                            <i class="icon_house_alt"></i>
                            <span>Dashboard</span>
                        </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_documents_alt"></i>
                            <span>Staffs</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('ss-manageStaff')}}">Manage Staff</a></li>
                <li><a class="" href="{{route('ss-listStaff')}}"><span>Active Staff</span></a></li>
                <li><a class="" href="{{route('ss-inactiveStaff')}}"><span>Inactive Staff</span></a></li>
                
              </ul>
            </li>
            
            <li>
              <a href="{{route('ss-manageClass')}}" class="">
                  <i class="icon_house"></i>
                  <span>Classes</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Students</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('ss-manageStudent')}}">Manage Student</a></li>
                <li><a class="" href="{{route('ss-listStudent')}}">View Students</a></li>
              </ul>
            </li>

            <li>
              <a href="{{ route('ss-manageSubject') }}" class="">
                  <i class="icon_document_alt"></i>
                  <span>Subjects</span>
                  <span class="menu-arrow arrow_carrot-right"></span>
              </a>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_desktop"></i>
                            <span>Assign</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">
                <li><a class="" href="{{route('ss-classTeacher')}}">Class Teacher</a></li>
                <li><a class="" href="{{route('ss-subjectTeacher')}}">Subject Teacher</a></li>
              </ul>
            </li>
            
            <li><a class="" href="{{url('ss-promoteStudent')}}"><i class="icon_house"></i>
              <span>Promotion</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('ss-listGraduates')}}"><i class="icon_house"></i>
              <span>Graduate List</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
            <li><a class="" href="{{url('ss-adminStudentResult')}}"><i class="icon_house"></i>
              <span>Student Result</span>
              <span class="menu-arrow arrow_carrot-right"></span></a>
            </li>
            
          </ul>
        @elseif(Auth::user()->role_id == 8)
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}"><i class="icon_house_alt"></i>
                <span>Dashboard</span>
              </a>

            </li><li><a class="" href="{{route('ss-manageResult')}}"><i class="icon_book"></i>
                <span>Input Result</span></a></li> 

            <li class="sub-menu">
              <a href="javascript:;" class="">
                            <i class="icon_table"></i>
                            <span>Class Teacher</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
              <ul class="sub">            
                <li><a class="" href="{{route('ss-checkResult')}}">Add Remark</a></li> 
                <li><a class="" href="{{route('ss-classResult')}}">Approve Result</a></li>
              </ul>
            </li>

          </ul>
        @else
          <ul class="sidebar-menu">
            <li class="active">
              <a class="" href="{{ route('dashboard') }}">
                  <i class="icon_house_alt"></i>
                  <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a class="" href="{{route('ss-principalRemark')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Add Remark</a>
            </li>       
            <li>
              <a class="" href="{{route('ss-principalApproval')}}"><i class="icon_book"></i>
              <span class="menu-arrow arrow_carrot-right"></span>Approve Result</a></li>
          </ul>
        @endif
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
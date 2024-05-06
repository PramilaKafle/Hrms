<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
          
            @cannot('hasEmployeeType')
            <a class="nav-link" href="{{url('redirect')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
               User Dashboard </a>
             @else 
            {{-- for specific project  --}}
             @if(isset($id))
             <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              {{$projects->name}}
                </button>
                <ul class="dropdown-menu">
                    
                  <li><a class="dropdown-item" href="{{route('project.dashboard')}}">Employee Dashboard</a></li>
                </ul>
              </div>
             @else
             {{-- ends here  --}}
             <a class="nav-link" href="{{url('redirect')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
               Employee Dashboard </a>
             @endif
             @endcannot
            
          
            <div class="sb-sidenav-menu-heading">Interface</div>
            @cannot('hasEmployeeType')
            <a class="nav-link" href="{{route('role.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
            Role Management
            </a>
            <a class="nav-link" href="{{route('user.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-secret"></i></div>
                User Management
            </a>
            <a class="nav-link" href="{{route('project.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
            Project Management
            </a>
         
         
            <a class="nav-link" href="{{route('employee.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Employee Management
            </a>
            <a class="nav-link" href="{{route('timesheet.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Timesheet Management
            </a>
            <a class="nav-link" href="{{route('leave.index')}}">
                <div class="sb-nav-link-icon"> <i class="fa-regular fa-calendar"></i></div>
            leave Management
            </a>
            <a class="nav-link" href="">
                <div class="sb-nav-link-icon"> <i class="fa-solid fa-file-export"></i></div>
            Report
            </a>
          
            @else

            @if(isset($id))
            <a class="nav-link" href="{{route('timesheet.view',$projects->id)}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-eye"></i></div>
                View Timesheet
            </a>
            <a class="nav-link" href="{{route('timesheet.create',$projects->id)}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Timesheet
            </a>
           
            @else
       
            <a class="nav-link" href="">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-user"></i></div>
                View Profile
            </a>
            {{-- <a class="nav-link" href="{{route('timesheet.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Timesheet
            </a> --}}
            <a class="nav-link" href="{{route('project.dashboard')}}" >
                <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                Project
            </a>
            <a class="nav-link" href="{{route('leave.index')}}">
                <div class="sb-nav-link-icon"> <i class="fa-regular fa-calendar"></i></div>
            leave Management
            </a>

         
            @endif
            @endcannot
            
          
           
        </div>
    </div>
 
</nav>


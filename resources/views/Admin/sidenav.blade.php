<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
           
           
            <a class="nav-link" href="{{url('redirect')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
             @cannot('hasEmployeeType')   User Dashboard @else Employee Dashboard @endcannot
            </a>
            @cannot('hasEmployeeType')
            <div class="sb-sidenav-menu-heading">Interface</div>

            <a class="nav-link" href="{{route('role.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
            Role Management
            </a>
            <a class="nav-link" href="{{route('project.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
            Project Management
            </a>
            <a class="nav-link" href="{{route('user.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-secret"></i></div>
                User Management
            </a>
         
            <a class="nav-link" href="{{route('employee.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Employee Management
            </a>
          
            @else
            <a class="nav-link" href="">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-user"></i></div>
                View Profile
            </a>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                Timesheet
            </a>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Expenses
            </a>
         
         
            @endcannot
            <a class="nav-link" href="{{route('leave.index')}}">
                <div class="sb-nav-link-icon"> <i class="fa-regular fa-calendar"></i></div>
            leave Management
            </a>
        </div>
    </div>
</nav>
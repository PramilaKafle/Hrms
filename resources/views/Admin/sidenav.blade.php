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
            <a class="nav-link" href="{{route('user.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-secret"></i></div>
                User Management
            </a>
         
            <a class="nav-link" href="{{route('employee.index')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Employee Management
            </a>
            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Employee Management
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{route('employee.create')}}">Create Employee</a>
                    <a class="nav-link" href="{{route('employee.index')}}">View Employee</a>
                </nav>
            </div> --}}
          
            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Leave Management
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> --}}
            {{-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                       View Leave
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div> --}}
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
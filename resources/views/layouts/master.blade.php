<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HRMS </title>
    <link href="{{ asset('Home/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('Home/css/calendar.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="sb-nav-fixed">
    @include('Home.navbar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">

            @include('Home.sidenav')
        </div>
        <div id="layoutSidenav_content">

            <div class="container-fluid px-4 mb-4">
                @yield('contents')
            </div>


            @include('Home.footer')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('Home/js/scripts.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('Home/js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('Home/js/calendar.js') }}"></script>
    <script src="{{ asset('Home/js/timesheetdata.js') }}"></script>
    <script src="{{ asset('Home/js/report.js') }}"></script>



    <!-- jQuery library -->


    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>


    @viteReactRefresh
    @vite('resources/js/app.jsx')


</body>

</html>

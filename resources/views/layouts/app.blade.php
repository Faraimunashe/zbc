<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ZBC - License | Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/chartist/chartist.min.css')}}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}')}}" />
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex align-items-center">
                    <a class="navbar-brand brand-logo" href="{{route('dashboard')}}">
                        <img src="{{asset('assets/images/zbbc.png')}}" alt="logo" class="logo-dark" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}">
                        <img src="{{asset('assets/images/zbbc.png')}}" alt="logo" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                    <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome ZBC dashboard!</h5>
                    <ul class="navbar-nav navbar-nav-right ml-auto">
                        <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <img class="img-xs rounded-circle ml-2" src="{{asset('assets/images/profile.png')}}" alt="Profile image">
                                <span class="font-weight-normal">{{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                                <div class="dropdown-header text-center">
                                    <img class="img-md rounded-circle" src="{{asset('assets/images/profile.png')}}" alt="Profile image">
                                    <p class="mb-1 mt-3">{{Auth::user()->name}}</p>
                                    <p class="font-weight-light text-muted mb-0">{{Auth::user()->email}}</p>
                                </div>
                                <a href="{{route('profile')}}" class="dropdown-item">
                                    <i class="dropdown-item-icon icon-user text-primary"></i>
                                    My Profile
                                </a>
                                <a href="https://faraimunashe.me" target="_blank" class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                                <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="dropdown-item-icon icon-power text-primary"></i>
                                    Sign Out
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                @include('layouts.navigation')
                <!-- partial -->
                <div class="main-panel">
                    {{$slot}}
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Faraimunashe 2022</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> From <a href="https://faraimunashe.me" target="_blank">Prof-Virus</a> Faraimunashe.me</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
        <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{ asset('assets/vendors/moment/moment.min.js')}}"></script>
        <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ asset('assets/vendors/chartist/chartist.min.js')}}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
        <script src="{{ asset('assets/js/misc.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset('assets/js/dashboard.js')}}"></script>
        <!-- End custom js for this page -->
    </body>
</html>

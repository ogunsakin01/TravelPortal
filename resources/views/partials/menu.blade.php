<div class="row transparent-menu">
    <div class="container clear-padding">
        <!-- BEGIN: HEADER -->
        <div class="navbar-wrapper">
            <div class="navbar navbar-default" role="navigation">
                <!-- BEGIN: NAV-CONTAINER -->
                <div class="nav-container">
                    <div class="navbar-header">
                        <!-- BEGIN: TOGGLE BUTTON (RESPONSIVE)-->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- BEGIN: LOGO -->
                        <a class="navbar-brand logo" href="{{ url('/') }}">{{config('app.name')}}</a>
                    </div>

                    <!-- BEGIN: NAVIGATION -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown @yield('activeHome')">
                                <a class="dropdown-toggle" href="{{ url('/') }}"> HOME </a>
                            </li>
                            <li class="dropdown @yield('activeFlights')">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"> FLIGHTS </a>
                            </li>
                            <li class="dropdown @yield('activeHotels')">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"> HOTELS </a>
                            </li>
                            <li class="dropdown @yield('activePackages')">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"> PACKAGES </a>
                            </li>
                            <li class="dropdown @yield('activeAboutUs')">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"> ABOUT US </a>
                            </li>
                            <li class="dropdown @yield('activeContactUs')">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"> CONTACT US </a>
                            </li>
                            <li class="dropdown @yield('activeLogin')">
                                <a class="dropdown-toggle" href="{{url('/login')}}" data-toggle="dropdown"> LOGIN </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END: NAVIGATION -->
                </div>
                <!--END: NAV-CONTAINER -->
            </div>
        </div>
        <!-- END: HEADER -->
    </div>
</div>
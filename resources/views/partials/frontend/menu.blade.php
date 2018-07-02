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
                            <li class="dropdown @yield('activeFlight')"><a class="dropdown-toggle" href="{{url('/deals/flight')}}">Flights</a></li>
                            <li class="dropdown @yield('activeHotel')"><a class="dropdown-toggle" href="{{url('/deals/hotel')}}">Hotels</a></li>
                            <li class="dropdown @yield('activeDeals')"><a class="dropdown-toggle" href="{{url('/deals')}}">Hot Deals</a></li>
                            <li class="dropdown @yield('activeVisaApplication')"><a class="dropdown-toggle" href="{{url('/visa-application')}}">Visa</a></li>
                            <li class="dropdown @yield('activeAboutUs')"><a class="dropdown-toggle" href="{{url('/about-us')}}">About Us</a></li>
                            @if(auth()->guest())
                            <li class="dropdown @yield('activeLogin')">
                                <a class="dropdown-toggle" href="{{url('/login')}}"> LOGIN </a>
                            </li>
                                @else
                                <li>
                                    <a href="{{url('/dashboard')}}"> <i class="fa fa-user"></i> My Bookings </a>
                                </li>
                            @endif
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
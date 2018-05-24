<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{url('/')}}">
                    <i class="la la-plane"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Book Flight</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('/')}}">
                    <i class="la la-hotel"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Book Hotel</span>
                </a>
            </li>
            <li class=" navigation-header"><span data-i18n="nav.category.layouts">Navigation</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
            </li>
            <li class="@yield('activeDashboard') nav-item">
                <a href="{{url('/dashboard')}}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
                </a>
            </li>
            <li class="@yield('activeBookings') nav-item"><a href="#"><i class="la la-history"></i><span class="menu-title" data-i18n="nav.templates.main">Bookings</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">Flight</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{url('/bookings/flight/user')}}">My Bookings</a>
                            </li>
                            <li><a class="menu-item" href="{{url('/bookings/flight/agent')}}">Agent</a>
                            </li>
                            <li><a class="menu-item" href="{{url('/bookings/flight/customer')}}">Customer</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Hotel</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{url('/bookings/hotel/user')}}">My Bookings</a>
                            </li>
                            <li><a class="menu-item" href="{{url('/bookings/hotel/agent')}}">Agent</a>
                            </li>
                            <li><a class="menu-item" href="{{url('/bookings/hotel/customer')}}">Customer</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Packages</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="" data-i18n="nav.templates.horz.classic">My Bookings</a>
                            </li>
                            <li><a class="menu-item" href="" data-i18n="nav.templates.horz.top_icon">Agent</a>
                            </li>
                            <li><a class="menu-item" href="" data-i18n="nav.templates.horz.top_icon">Customer</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item @yield('activeSettings')"><a href="#"><i class="la la-cogs"></i><span class="menu-title" data-i18n="nav.page_layouts.main">Settings</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{url('settings/vats')}}" data-i18n="nav.page_layouts.1_column">Vats</a>
                    </li>
                    <li><a class="menu-item" href="{{url('settings/markups')}}" data-i18n="nav.page_layouts.2_columns">Markups</a>
                    </li>
                    <li><a class="menu-item" href="{{url('settings/markdown')}}" data-i18n="nav.page_layouts.2_columns">Markdowns</a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.page_layouts.2_columns">Vouchers</a>
                    </li>
                    <li><a class="menu-item" href="{{route('banks')}}" data-i18n="nav.page_layouts.2_columns">Banks</a>
                    </li>
                    <li><a class="menu-item" href="{{url('settings/users')}}" data-i18n="nav.page_layouts.2_columns">Users Management</a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.page_layouts.2_columns">Email Subscribers</a>
                    </li>
                    <li><a href="{{url('settings/wallets')}}" class="menu-item">Wallets Management</a></li>
                    </li>
                </ul>
            </li>
            <li class="nav-item @yield('activeTransaction')"><a href="#"><i class="la la-money"></i><span class="menu-title" data-i18n="nav.navbars.main">Transactions(Payments)</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{url('/transactions/online-payment')}}" data-i18n="nav.navbars.nav_dark">Online</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{url('/transactions/bank-payment')}}" data-i18n="nav.navbars.nav_semi">Offline(Bank)</a>
                    </li>
                    <li>
                        <a class="menu-item" href="" data-i18n="nav.navbars.nav_brand_center">Pay Later</a>
                    </li>
                </ul>
            </li>

            <li class="@yield('activeTravelPackage') nav-item"><a href="#"><i class="la la-suitcase"></i><span class="menu-title" data-i18n="nav.vertical_nav.main">Travel Packages</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="" data-i18n="nav.vertical_nav.vertical_nav_fixed">Categories</a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.vertical_nav.vertical_nav_fixed">Create</a>
                    </li>
                    <li><a class="menu-item" href="" data-i18n="nav.vertical_nav.vertical_nav_fixed">All</a>
                    </li>
                </ul>
            </li>
            <li class=" @yield('activeProfile') nav-item">
                <a href="{{route('backend-profile-view')}}">
                    <i class="la la-user"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Profile</span>
                </a>
            </li>
            <li class="@yield('activeMyWallet') nav-item">
                <a href="{{url('settings/wallets/user-wallet')}}">
                    <i class="la la-google-wallet"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">My Wallet</span>
                </a>
            </li>
        </ul>
    </div>
</div>
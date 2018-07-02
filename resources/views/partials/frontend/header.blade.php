<div class="row transparent-menu-top">
    <div class="container clear-padding">
        <div class="navbar-contact">
            <div class="col-md-5 col-sm-6 clear-padding">
                <a href="#" class="transition-effect"><i class="fa fa-phone"></i> {{\App\Services\PortalConfig::$adminBookingsNumber}}</a>
                <a href="#" class="transition-effect"><i class="fa fa-envelope-o"></i> {{\App\Services\PortalConfig::$adminBookingsEmail}}</a>
            </div>
            <div class="col-md-7 col-sm-6 clear-padding search-box">
                <div class="col-md-5 col-xs-5 clear-padding">
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" required placeholder="Search">
                            <span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
                        </div>
                    </form>
                </div>
                @if(auth()->guest())
                <div class="col-md-7 col-xs-7 clear-padding user-logged">
                    <a href="#" class="transition-effect">
                        <img src="{{asset('frontend/assets/images/portal_images/user.png')}}" alt="user">
                    </a>
                    <a href="{{url('/login')}}" class="transition-effect">
                        <i class="fa fa-sign-in"></i>Sign in
                    </a>
                </div>
                    @elseif(auth()->user())
                    <div class="col-md-7 col-xs-7 clear-padding user-logged">
                        <a href="{{url('/dashboard')}}" class="transition-effect">
                            @if(!empty(\App\Profile::getUserInfo(auth()->user()->id)->photo))
                            <img src="{{asset(\App\Profile::getUserInfo(auth()->user()->id)->photo)}}" alt="{{\App\Profile::getUserInfo(auth()->user()->id)->first_name}}">
                            @else
                            <img src="{{asset('frontend/assets/images/portal_images/user.png')}}" alt="user">
                            @endif
                            Hi, {{\App\Profile::getUserInfo(auth()->user()->id)->first_name}}
                        </a>
                        <a class="btn btn-primary btn-sm" href="{{url('/dashboard')}}">
                            Bookings
                        </a>
                        <a href="{{url('/logout')}}" class="transition-effect">
                            <i class="fa fa-sign-out"></i>Sign Out
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
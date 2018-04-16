<!DOCTYPE html>
<html class="load-full-screen">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="LimpidThemes">

    <title>{{config('app.name')}} - @yield('page-title')</title>

    <script type="text/javascript">
        var baseUrl = "{{url("/")}}";
        var path = "{{ route('typeaheadJs') }}";
        var airline_path = "{{route('airlineTypeAheadJs')}}";
    </script>
     @include('partials.css')
     @yield('css')
</head>
<body class="load-full-screen">

<!-- BEGIN: PRELOADER -->
<div id="loader" class="hidden load-full-screen">
    <div class="loading-animation">
        <span> <i class="fa fa-plane"></i>    </span>
        <span> <i class="fa fa-bed"></i>      </span>
        <span> <i class="fa fa-ship"></i>     </span>
        <span> <i class="fa fa-suitcase"></i> </span>
    </div>
</div>
<!-- END: PRELOADER -->

<!-- BEGIN: COLOR SWITCHER -->

<!-- END: COLOR SWITCHER -->

<!-- BEGIN: SITE-WRAPPER -->
<div class="site-wrapper">
    <!-- BEGIN: NAV SECTION -->
    <section>
        @include('partials.header')
        <div class="clearfix"></div>
        @include('partials.menu')
    </section>
    <!-- END: NAV SECTION -->

   @yield('content')

    <!-- START: FOOTER -->
    @include('partials.footer')
    <!-- END: FOOTER -->
</div>
<!-- END: SITE-WRAPPER -->

<!-- BEGIN : LOADING PAGE -->
@include('partials.flight_booking_loader')
@include('partials.flight_information_loader')
@include('partials.flight_search_loader')
@include('partials.flight_multi_search_loader')
@include('partials.hotel_booking_loader')
@include('partials.hotel_information_loader')
@include('partials.hotel_room_information')
@include('partials.hotel_search_loader')


<!-- END : LOADING PAGE -->
{!! Toastr::render() !!}
<!-- Load Scripts -->
@include('partials.javascript')
@yield('javascript')
</body>
</html>
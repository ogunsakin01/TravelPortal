<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="travel, tourism, tickets, flight, hotel">
    <meta name="author" content="{{config('app.name')}}">
    <title> {{config('app.name')}} - @yield('page-title')</title>
@include('partials.backend.css')
@yield('css')
<!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-content-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-content-menu" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<!-- BEGIN VENDOR JS-->
@include('partials.backend.js')
@yield('javascript')
{!! Toastr::render() !!}
<!-- END PAGE LEVEL JS-->
</body>
</html>
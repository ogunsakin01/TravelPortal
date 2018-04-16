@extends('layouts.app')

@section('page-title') 404 @endsection

@section('content')

    <!-- BEGIN: CONTENT-->
    <section>
        <div class="row not-found">
            <div class="container">
                <p class="large-para text-center"><span class="fa fa-chain-broken"></span>404</p>
                <div class="text-center desc">
                    <h1>Page Not Found</h1>
                    <p>Looks like you are lost.</p>
                    <a href="#"><i class="fa fa-home"></i>Homepage</a>
                </div>
            </div>
        </div>
        <!-- END: CONTENT -->
    </section>

@endsection

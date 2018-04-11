@extends('layouts.app')

@section('page-title') 403 @endsection

@section('content')

    <!-- BEGIN: CONTENT-->
    <section>
        <div class="row not-found">
            <div class="container">
                <p class="large-para text-center"><span class="fa fa-chain-broken"></span>403</p>
                <div class="text-center desc">
                    <h1>Forbidden Page</h1>
                    <p>You shouldn't be here</p>
                    <a href="#"><i class="fa fa-home"></i>Homepage</a>
                </div>
            </div>
        </div>
        <!-- END: CONTENT -->
    </section>

@endsection

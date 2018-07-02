@extends('layouts.error')

@section('page-title') 505 @endsection

@section('content')

    <!-- BEGIN: CONTENT-->
    <section>
        <div class="row not-found">
            <div class="container">
                <p class="large-para text-center"><span class="fa fa-chain-broken"></span>505</p>
                <div class="text-center desc">
                    <h1>Troubleshooting Error</h1>
                    <p>Looks like something is wrong.</p>
                    <a href="{{url('/')}}" class="btn btn-primary btn-block"><i class="ft-arrow-left"></i> GO BACK</a>
                </div>
            </div>
        </div>
        <!-- END: CONTENT -->
    </section>

@endsection

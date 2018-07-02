@extends('layouts.error')

@section('page-title') 404 @endsection

@section('content')

    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 p-0">
                <div class="card-header bg-transparent border-0">
                    <h2 class="error-code text-center mb-2">404</h2>
                    <h3 class="text-uppercase text-center">Page Not Found !</h3>
                    <a href="{{url('/')}}" class="btn btn-primary btn-block"><i class="ft-arrow-left"></i> GO BACK</a>
                </div>
            </div>
        </div>
    </section>

@endsection

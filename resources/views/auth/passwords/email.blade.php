

@extends('layouts.auth')

@section('page-title')  Recover Password @endsection

@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                @if (session('status'))
                    <div class="alert round bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Great !!! </strong> {{ session('status') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $serial => $error)
                        <div class="alert round bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Oh snap!</strong> {{$error}}
                        </div>
                    @endforeach
                @endif
                <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title text-center">
                            <img src="{{asset('backend/app-assets/images/logo/logo.png')}}" alt="{{config('app.name')}}">
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>We will send you a link to reset password.</span></h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('password.email') }}" method="post" novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="email" class="form-control form-control-lg input-lg" name="email" id="user-email" placeholder="Your Email Address" required>
                                    <div class="form-control-position">
                                        <i class="ft-mail"></i>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Recover Password</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer border-0">
                        <p class="float-sm-left text-center"><a href="{{url('/login')}}" class="card-link">Login</a></p>
                        <p class="float-sm-right text-center">New to {{config('app.name')}} ? <a href="{{url('/register')}}" class="card-link">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
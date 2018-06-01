@extends('layouts.auth')

@section('page-title')  Login @endsection

@section('content')

    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
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
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div class="p-1"><img src="{{asset('backend/app-assets/images/logo/logo.png')}}" alt="{{config('app.name')}}"></div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with {{config('app.name')}}</span></h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" method="post" action="{{ route('login')}}" >
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="email" class="form-control form-control-lg input-lg" name="email" id="email" placeholder="Your Email" required>
                                    <div class="form-control-position">
                                        <i class="ft-envelope"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control form-control-lg input-lg" id="password" name="password" placeholder="Enter Password" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-md-6 col-12 text-center text-md-left">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" class="chk-remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember-me"> Remember Me</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="">
                            <p class="float-sm-left text-center m-0"><a href="{{ route('password.request') }}" class="card-link">Recover password</a></p>
                            <p class="float-sm-right text-center m-0">New to {{config('app.name')}}? <a href="{{url('/register')}}" class="card-link">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

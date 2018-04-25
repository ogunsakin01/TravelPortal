@extends('layouts.app')

@section('page-title') Sign Up / Sign In  @endsection

@section('content')

    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>LOGIN/REGISTER</h3>
            <h4 class="thank">Manage Your Account</h4>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: LOGIN/REGISTER -->
    <div class="row login-row">
        <div class="container clear-padding">
            <div class="col-sm-2 useful-links">
                <h4>Useful Links</h4>
                <a href="#">Become A Partner</a>
                <a href="#">Career</a>
                <a href="#">Developers</a>
                <a href="#">FAQ</a>
                <a href="#">Partners</a>
                <a href="#">Terms Of Use</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="col-sm-3 login-form">
                <h4>Login</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>{{ __('E-Mail Address') }}</label>
                    <div class="input-group">
                        <input name="email" type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username/Email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @else
                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                        @endif
                    </div>
                    <label>{{ __('Password') }}</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                           <strong>{{ $errors->first('password') }}</strong>
                         </span>
                        @else
                            <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                        @endif
                    </div>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    <button type="submit">{{ __('Login') }} <i class="fa fa-sign-in"></i></button>

                </form>
            </div>
            <div class="col-sm-7 sign-up-form">
                <h4>Sign Up</h4>
                <form method="POST" action="{{ route('register') }}">

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Surname</label>
                            <div class="input-group">
                                <input name="sur_name" type="text" class="form-control" placeholder="Surname (Family name)" required>
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>First name</label>
                            <div class="input-group">
                                <input name="first_name" type="text" class="form-control" placeholder="First name (Your name)" required>
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Other name</label>
                            <div class="input-group">
                                <input name="other_name" type="text" class="form-control" placeholder="Other name (Your other name)" required>
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control" placeholder="Email" required>
                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <div class="input-group">
                                <input name="phone" type="tel" class="form-control" placeholder="Phone number" required>
                                <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype Password">
                                <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                            </div>
                        </div>
                    </div>
                    <input name="tc" type="checkbox" required> I agree To Terms & Conditions
                    <button type="submit"> {{ __('Register') }} <i class="fa fa-edit"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

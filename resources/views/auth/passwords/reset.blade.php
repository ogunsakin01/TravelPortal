@extends('layouts.app')

@section('page-title') Reset Password @endsection

@section('content')

    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>PASSWORD RESET</h3>
            <h4 class="thank">Reset Password</h4>
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
            <div class="col-sm-10 sign-up-form">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h4>Sign Up</h4>
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Email</label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control" placeholder="Email" value="{{ $email ?? old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @else
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @else
                                    <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype Password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @else
                                    <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

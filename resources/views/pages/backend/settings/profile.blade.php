@extends('layouts.backend')

@section('page-title') User Profile  @endsection

@section('activeSettings') open hover  @endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

            <!-- Photo & Description card -->
            <div class="profile-side">
                <div class="profile-photo">
                    @if(empty($profile->photo))
                        <img src="{{asset('backend/img/logo-invert.png')}}" class="circle" alt="">
                    @else
                        <img src="{{$profile->photo}}" class="circle" alt="">
                    @endif
                    <div class="prof-name">
                       {{$profile->sur_name,' ',$profile->first_name}}
                    </div>
                    <div class="prof-title">

                    </div>
                </div>
                <div class="profile-body">
                    <div class="prof-misc">
                        <span class="ti-time mr-2"></span>
                        Signed Up {{date('d D, M Y G:i A',strtotime($user->created_at))}}
                    </div>
                </div>
            </div>
            <!-- /End Photo & Description card -->

        </div>

        <div class="col-md-9">

            <!-- Main Profile card -->
            <div class="card">
                <ul class="nav nav-tabs card-header" id="profile" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile_tab" aria-expanded="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change_password_tab" aria-expanded="false">Change Password</a>
                    </li>
                </ul>

                <div class="card-body">
                    <div class="tab-content profile-content" id="profileContent">

                        <!-- Dashboard tab -->
                        <div class="tab-pane fade active show" id="profile_tab" aria-expanded="true">

                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="subheading">
                                        Basic Information
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Fullname</div>
                                <div class="col-sm-10">
                                    {{$profile->sur_name}} {{$profile->first_name}} {{$profile->other_name}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Birthday</div>
                                <div class="col-sm-10">
                                  {{--  {{$profile->first_name}}--}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Address</div>
                                <div class="col-sm-10">
                                    {{$profile->address}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Gender</div>
                                <div class="col-sm-10">
{{--                                    {{$profile['gender']}}--}}
                                </div>
                            </div>

                            <div class="row mt-4  mb-2">
                                <div class="col-12">
                                    <div class="subheading">
                                        Contact Information
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Email</div>
                                <div class="col-sm-10">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Phone</div>
                                <div class="col-sm-10">
                                    {{$profile->phone_number}}
                                </div>
                            </div>

                            <div class="row mt-4 mb-2">
                                <div class="col-12">
                                    <div class="subheading">
                                        Account Information
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Account Status</div>
                                <div class="col-sm-10">
                                  {{--  @php
                                        echo $profile['account_status']
                                    @endphp--}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Created On</div>
                                <div class="col-sm-10">
{{--                                    {{$sign_up_date}}--}}
                                </div>
                            </div>

                            @role('agent')
                            <div class="row mt-4 mb-2">
                                <div class="col-12">
                                    <div class="subheading">
                                        Agency Information
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Agency Name</div>
                                <div class="col-sm-10">
{{--                                    {{$profile['agency_name']}}--}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Agency ID</div>
                                <div class="col-sm-10">
{{--                                    {{$profile['agent_id']}}--}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-2 text-muted">Office Number</div>
                                <div class="col-sm-10">
{{--                                    {{$profile['office_number']}}--}}
                                </div>
                            </div>
                            @endrole

                        </div>
                        <!-- /End Dashboard tab -->

                        <!-- Messages tab -->
                        <div class="tab-pane fade" id="change_password_tab" aria-expanded="false">
                            {!! Form::open(['route' => 'profile']) !!}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('','Old Password') !!}
                                        {!! Form::password('old_password', ['id'=>'old_password', 'class'=>'form-control', 'placeholder'=>'********']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('','New Password') !!}
                                        {!! Form::password('new_password', ['id'=>'new_password', 'class'=>'form-control', 'placeholder'=>'********']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('','Confirm Password') !!}
                                        {!! Form::password('confirm_password', ['id'=>'confirm_password', 'class'=>'form-control', 'placeholder'=>'********']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-alt-primary pull-right btn-sm" type="button" id="change_password" name="change_password">Change</button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /End Messages tab -->

                    </div><!-- .profile-content -->
                </div><!-- .card-body -->
            </div><!-- .card -->
            <!-- /End Main Profile card -->

        </div><!-- .col -->
    </div>

@endsection

@section('javascript')

    <script src="{{asset('backend/js/pages/passwords.js')}}"></script>

@endsection

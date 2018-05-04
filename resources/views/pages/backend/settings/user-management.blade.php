@extends('layouts.backend')

@section('page-title') Profie Management  @endsection

@section('activeSettings') open hover  @endsection

@section('content')
    <section class="row">

        <div class="col-lg-3 col-md-2 col-sm-12">
            <div class="card">
                <!-- contacts view -->
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">All Users<span class="badge badge-primary badge-pill float-right">14</span></a>
                        <a href="#" class="list-group-item list-group-item-action">Admin <span class="badge badge-primary badge-pill float-right">1</span></a>
                        <a href="#" class="list-group-item list-group-item-action">Agents <span class="badge badge-primary badge-pill float-right">3</span></a>
                        <a href="#" class="list-group-item list-group-item-action">Customers <span class="badge badge-primary badge-pill float-right">10</span></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade text-left" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="">

                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Create User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 sign-up-form">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Surname</label>
                                        <div class="input-group">
                                            <input name="sur_name" type="text" class="form-control" placeholder="Surname (Family name)" required>
                                            <span class="input-group-addon"><i class="la la-user la-fw"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>First name</label>
                                        <div class="input-group">
                                            <input name="first_name" type="text" class="form-control" placeholder="First name (Your name)" required>
                                            <span class="input-group-addon"><i class="la la-user fa-fw"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Other name</label>
                                        <div class="input-group">
                                            <input name="other_name" type="text" class="form-control" placeholder="Other name (Your other name)" required>
                                            <span class="input-group-addon"><i class="la la-user fa-fw"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                                            <span class="input-group-addon"><i class="la la-envelope-o fa-fw"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <div class="input-group">
                                            <input name="phone" type="tel" class="form-control" placeholder="Phone number" required>
                                            <span class="input-group-addon"><i class="la la-phone fa-fw"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                            <span class="input-group-addon"><i class="la la-eye fa-fw"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm Password</label>
                                        <div class="input-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype Password">
                                            <span class="input-group-addon"><i class="la la-eye fa-fw"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" {{ __('Register') }} class="btn btn-outline-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-9 col-md-10 col-sm-12">
            <div class="card">
                <div class="card-head">
                    <div class="card-header">
                        <h4 class="card-title">All Users</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-user"><i class="ft-plus white"></i> Create New User</button>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <!-- Task List table -->
                        <div class="table-responsive">
                            <table id="users-contacts" class="table table-white-space datatable table-bordered row-grouping display no-wrap icheck table-middle">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        @if(!empty($user->id))
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                    {{ $user->sur_name.' '. $user->first_name.' '.$user->other_name}}
                                                </td>
                                                <td class="text-center">
                                                    {{\App\User::find($user->user_id)->email}}
                                                </td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td class="text-center">

                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><i class="ft-edit-2 white" data-toggle="modal" data-target="#edit_user{{ $user->id }}"></i> Edit</button>

                                                    <button class="btn btn-sm btn-outline-red" data-toggle="modal" data-target="#"><span><i class="ft-trash-2"></i></span> Delete </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('javascript')

    <script src="{{asset('backend/js/pages/passwords.js')}}"></script>

@endsection

<style>

</style>
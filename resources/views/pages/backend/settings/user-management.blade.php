@extends('layouts.backend')

@section('page-title') Users Management  @endsection

@section('activeSettings') open hover  @endsection

@section('content')


    <section class="row">

       <div class="modal fade text-left" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{url('/settings/users/add-new')}}">

                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title" id="myModalLabel17">Create User</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 sign-up-form">
                               <div class="row">
                                   <div class="col-md-4">
                                       <div class="form-group">
                                           <label>Title</label>
                                           <select class="form-control" name="title_id" required>
                                            @foreach($titles as $serial => $title)
                                             <option value="{{$title->id}}">{{$title->name}}</option>
                                            @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <div class="form-group">
                                         <label>Gender</label>
                                           <select class="form-control" name="gender_id" required>
                                               @foreach($genders as $serial => $gender)
                                                   <option value="{{$gender->id}}">{{$gender->type}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-4">
                                       <label>User Type</label>
                                       <select class="form-control" name="user_type" required>
                                           @foreach($roles as $serial => $role)
                                               <option value="{{$role->id}}">{{$role->display_name}}</option>
                                           @endforeach
                                       </select>
                                   </div>
                               </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Surname</label>
                                            <input name="sur_name" type="text" class="form-control" placeholder="Surname (Family name)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input name="first_name" type="text" class="form-control" placeholder="First name (Your name)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Other name</label>
                                            <input name="other_name" type="text" class="form-control" placeholder="Other name (Your other name)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input name="phone" type="tel" class="form-control" placeholder="Phone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" required>

                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-outline-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            @if ($errors->any())
                @foreach($errors->all() as $i => $error)
                    <div class="alert round bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Oh snap!</strong> {{$error}}
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">All Users</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-user"><i class="ft-plus white"></i> Create New User</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                {{--<th>SN</th>--}}
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profile Status</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                 @foreach($users as $serial => $user)
                                     <div class="modal fade text-left edit_user_{{$user->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
                                          aria-hidden="true">
                                         <div class="modal-dialog modal-lg" role="document">
                                             <div class="modal-content">
                                                 <form method="POST" action="{{url('/settings/users/update-user')}}">

                                                     @csrf
                                                     <input type="hidden" value="{{$user->user_id}}" name="user_id"/>
                                                     <div class="modal-header">
                                                         <h3 class="modal-title" id="myModalLabel17">Create User</h3>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                         </button>
                                                     </div>
                                                     <div class="modal-body">
                                                         <div class="col-sm-12 sign-up-form">
                                                             <div class="row">
                                                                 <div class="col-md-4">
                                                                     <div class="form-group">
                                                                         <label>Title</label>
                                                                         <select class="form-control" name="title_id" required>
                                                                             <option value="{{$user->title_id}}">{{\App\Title::find($user->title_id)->name}}</option>
                                                                             @foreach($titles as $serial => $title)
                                                                                 <option value="{{$title->id}}">{{$title->name}}</option>
                                                                             @endforeach
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                     <div class="form-group">
                                                                         <label>Gender</label>
                                                                         <select class="form-control" name="gender_id" required>
                                                                             <option value="{{$user->gender_id}}">{{\App\Gender::find($user->gender_id)->type}}</option>
                                                                             @foreach($genders as $serial => $gender)
                                                                                 <option value="{{$gender->id}}">{{$gender->type}}</option>
                                                                             @endforeach
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                     <label>User Type</label>
                                                                     <select class="form-control" name="user_type" required>
                                                                         <option value="{{$user->role_id}}">{{\App\Role::find($user->role_id)->display_name}}</option>
                                                                         @foreach($roles as $serial => $role)
                                                                             <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                                         @endforeach
                                                                     </select>
                                                                 </div>
                                                             </div>
                                                             <div class="row">
                                                                 <div class="col-md-4">
                                                                     <div class="form-group">
                                                                         <label>Surname</label>
                                                                         <input name="sur_name" value="{{$user->sur_name}}" type="text" class="form-control" placeholder="Surname (Family name)" required>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                     <div class="form-group">
                                                                         <label>First name</label>
                                                                         <input name="first_name" type="text" value="{{$user->first_name}}" class="form-control" placeholder="First name (Your name)" required>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                     <div class="form-group">
                                                                         <label>Other name</label>
                                                                         <input name="other_name" type="text" value="{{$user->other_name}}" class="form-control" placeholder="Other name (Your other name)">
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="row">
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <label>Email</label>
                                                                         <input name="email" type="email" value="{{$user->email}}" class="form-control" placeholder="Email" required>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <label>Phone</label>
                                                                         <input name="phone" type="tel" value="{{$user->phone_number}}" class="form-control" placeholder="Phone number" required>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="row">
                                                                 <div class="col-md-12">
                                                                     <div class="form-group">
                                                                         <label>Address</label>
                                                                         <textarea class="form-control" name="address" required>{{$user->address}}</textarea>
                                                                     </div>
                                                                 </div>
                                                             </div>

                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                         <button type="submit"  class="btn btn-outline-primary">Update User</button>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>

                                     <tr class="user_id_{{$user->user_id}}">
                                         <td>{{$user->sur_name}} {{$user->first_name}} {{$user->other_name}}</td>
                                         <td>{{$user->email}}</td>
                                         <td>{{$user->phone_number}}</td>
                                         <td>
                                             @if($user->profile_complete_status == 0)
                                                 <p class="warning"><i class="la la-warning"></i> Incomplete</p>
                                             @elseif($user->profile_complete_status == 0)
                                                 <p class="success"><i class="la la-success"></i> Complete</p>
                                             @endif
                                         </td>
                                         <td>
                                             @if($user->role_id == 1)
                                                 <p class="danger">Super Admin</p>
                                             @elseif($user->role_id == 2)
                                                 <p class="success">Agent</p>
                                             @elseif($user->role_id == 3)
                                                 <p class="info"> Customer</p>
                                             @endif
                                         </td>
                                         <td>
                                         <span class="dropdown">
				                        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
				                        <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                            <button class="dropdown-item btn edit_user" data-toggle="modal" data-target=".edit_user_{{$user->user_id}}" value="{{$user->user_id}}"><i class="la la-edit"></i> Edit</button>
                                            <button class="dropdown-item btn delete_user" value="{{$user->user_id}}"><i class="la la-trash"></i> Delete</button>
				                        </span>
				                    </span>
                                         </td>
                                     </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('javascript')

    <script src="{{asset('backend/js/pages/users-management.js')}}"></script>

@endsection

<style>

</style>
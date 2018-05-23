<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use App\Services\PortalCustomNotificationHandler;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use nilsenj\Toastr\Facades\Toastr;
use App\Wallet;
use App\RoleUser;

class UserController extends Controller
{

    public function guard()
    {
        return Auth::guard();
    }

    public function index()
    {
        $users    = User::join('profiles','profiles.user_id','=','users.id')
                          ->join('role_user','role_user.user_id','=','users.id')
                          ->get();
                return view('pages.backend.settings.user-management',compact('users'));
    }

    public function createUser(Request $request){

        $this->validate($request, [
            'sur_name'   => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'phone'      => 'required',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $user = User::store($request);

        $user->attachRole(3);

        $request['user'] = $user;

        Profile::store($request);

    }

    public function addNew(Request $data){

        $this->validate($data,[
            'sur_name'   => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'phone'      => 'required',
            'address'    => 'required',
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->attachRole($data['user_type']);

        $profile = Profile::create([
            'user_id'       => $user->id,
            'title_id'      => $data['title_id'],
            'gender_id'     => $data['gender_id'],
            'sur_name'      => $data['sur_name'],
            'first_name'    => $data['first_name'],
            'other_name'    => array_get($data,'first_name',''),
            'phone_number'  => $data['phone'],
            'address'       => $data['address'],
            'photo'         => array_get($data,'photo',''),
        ]);

        if($profile AND $user){
            Toastr::success('New users created successfully');
        }
        else{
            Toastr::error('Unable to create new user');
        }

        if($user->hasRole('agent') || $user->hasRole('admin')){
             Wallet::create([
                 'user_id' => $user->id,
                 'balance' => 0
             ]);
        }

        return back();

    }

    public function signIn(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if(Auth::attempt([
            'email' => $request->get ( 'email' ),
            'password' => $request->get ( 'password' )
            ])){

            session ([
                'email' => $request->get ( 'email' )
            ]);

            return response()->json($this->guard()->user(), 200);
        }
        else{
            return response()->json(false);
        }
    }

    public function signUp(Request $request){

        $this->validate($request, [
            'sur_name'   => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'phone'      => 'required',
            'password'   => 'required|string|min:6|confirmed',
        ]);


        $user = User::store($request);

        $user->attachRole(3);

        $request['user'] = $user;

        Profile::store($request);

        PortalCustomNotificationHandler::registrationSuccessful($user);

        if(Auth::attempt([
            'email' => $request->get ( 'email' ),
            'password' => $request->get ( 'password' )
        ])){

            session ([
                'email' => $request->get ( 'email' )
            ]);

            return response()->json($this->guard()->user(), 200);
        }
        else{
            return response()->json(false);
        }

    }

    public function changePassword(array $r){
        $user = new User();
        return $user->changePassword($r);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete_status = 1;
        $user->update();
        return $user;
    }

    public function updateUser(Request $request){


        $this->validate($request, [
            'sur_name'   => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'phone'      => 'required',
            'address'    => 'required'
        ]);



        $user = User::find($request->user_id);

        if($request->email != $user->email){
            $this->validate($request, [
                'email'      => 'required|string|email|max:255|unique:users',
            ]);
        }

        $user->email = $request->email;
        $updateUser = $user->update();

        $profile = Profile::where('user_id',$request->user_id)->first();
        $profile->title_id     = $request->title_id;
        $profile->gender_id    = $request->gender_id;
        $profile->sur_name     = $request->sur_name;
        $profile->first_name   = $request->first_name;
        $profile->other_name   = $request->other_name;
        $profile->phone_number = $request->phone;
        $profile->address      = $request->address;
        $updateProfile = $profile->update();
        $userRole = RoleUser::where('user_id',$request->user_id)->first()->role_id;

        if($userRole != $request->user_type){
            $user->detachRole($userRole);
           $user->attachRole($request->user_type);
        }

        if($updateUser AND $updateProfile){
            Toastr::success('User information updated successfully');
        }
        else{
            Toastr::error('Unable to edit user information');
        }

        if($request->user_type != 3){
            Wallet::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'balance' => 0
                ]);
        }
        return back();
    }

}

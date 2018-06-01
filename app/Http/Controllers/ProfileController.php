<?php

namespace App\Http\Controllers;
use App\Role;
use App\Services\PortalCustomNotificationHandler;
use App\User;
use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profileView()
    {
        $user = new User();

        $role = new Role();

        $name = $user->getAuthenticatedUserFullName();

        $sign_up_date = $user->userCreatedDate();

        $role = $role->role(auth()->id());

        $profile = $user->authenticatedUserProfile();

        return view('pages.backend.settings.profile', compact('name', 'role','sign_up_date', 'profile'));
    }

    public function updateUserProfile(Request $r){

        $this->validate($r,[
            'customer_sur_name'    => 'required|string|max:255',
            'customer_first_name'   => 'required|string|max:255',
            'customer_other_name'     => 'required|string|max:255',
            'customer_phone_number'  => 'required|digits:11',
            'customer_address'       => 'required',
        ]);

        $profile = Profile::where('user_id',auth()->user()->id)->first();
        $profile->sur_name = $r->customer_sur_name;
        $profile->first_name = $r->customer_first_name;
        $profile->other_name = $r->customer_other_name;
        $profile->phone_number = $r->customer_phone_number;
        $profile->address = $r->customer_address;
        $update = $profile->update();
        if($update){
            return $profile;
        }
        return 0;

    }

    public function updateUserProfilePassword(Request $r){

        $this->validate($r,[
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($r->password);
        $update = $user->update();

        if($update){
            PortalCustomNotificationHandler::passwordReset();
            return $user;
        }

        return 0;

    }
    

    public function updateProfileImageJs(Request $r){

        $file      = $r->file('customer_profile_photo');
        $fileName  = time().$file->getClientOriginalName();
        $file_path = 'images/users/profile/'.$fileName;
        $file->move(public_path('/images/users/profile/'),$fileName);
        $profile = Profile::where('user_id',auth()->user()->id)->first();
        $profile->photo = $file_path;
        $update = $profile->update();

        if($update){
            return $profile;
        }else{
            return 0;
        }

    }

}

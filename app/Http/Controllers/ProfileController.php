<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
}

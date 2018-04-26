<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use App\Services\PortalCustomNotificationHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class authAPIController extends Controller
{

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    public function register(Request $data){

        $this->validate($data, [
            'sur_name'   => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'other_name' => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'phone'      => 'required',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        $user->attachRole(3);

        $data['user'] = $user;

        Profile::store($data);

        PortalCustomNotificationHandler::registrationSuccessful($user);

        return response()->json($user, 200);

    }

    public function login(Request $data){

      $this->validate($data, [
           'email'    => 'required|string',
           'password' => 'required|string'
       ]);

        if ($this->attemptLogin($data)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return response()->json(['data' => 'Invalid login credentials.'], 200);

    }

    public function logout(Request $data){

        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }

}

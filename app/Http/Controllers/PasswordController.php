<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function changePassword(Request $r)
    {
        $user = new User();

        $this->validate($r, [
            'old_password' => 'required',
            'new_password' => 'required|same:confirm_password',
            'confirm_password' => 'required'
        ]);


        if ($user->checkPassword($r->all()))
        {
            if ($user->changePassword($r->all()))
            {
                /*
                 * Password changed
                 * */
                $response = 1;

                return response()->json($response);
            }
            else
            {
                /*
                 * Could not change password
                 * */
                $response = 0;

                return response()->json($response);
            }
        }
        else
        {
            /*
             * Password Incorrect
             * */

            $response = 2;

            return response()->json($response);
        }
        return $r;
    }
}

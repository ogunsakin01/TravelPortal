<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public function fetchRoles()
    {
        return static::pluck('name', 'id')->all();
    }

    public function fetchRolesExceptAdmin()
    {
        return static::where('id', '!=', '1')->pluck('name', 'id');
    }

    public function getRoleName($role_id)
    {
        return static::where('id', $role_id)->first()->name;
    }

    public function getUserRole($user_id)
    {
        $role = DB::table('role_user')->where('user_id',$user_id)->first();

        return $role->role_id;
    }

    public function role($user_id)
    {
        return $this->getRoleName($this->getUserRole($user_id));
    }
}

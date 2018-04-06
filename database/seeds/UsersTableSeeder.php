<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [

            [
                'id' =>  1,
                'email' => 'admin@travelportal.com',
                'password' => bcrypt('admin')
            ],
            [
                'id' =>  2,
                'email' => 'agent@travelportal.com',
                'password' => bcrypt('agent')
            ],
            [
                'id' =>  3,
                'email' => 'customer@travelportal.com',
                'password' => bcrypt('customer')
            ],
        ];

        foreach($users as $serial => $user){
           $createUser = User::create($user);
           $createUser->attachRole($serial+1);
        }

        $defaultOriginalUser =  [
            'id' =>  4,
            'email' => 'ogunsakin191@gmail.com',
            'password' => bcrypt('ogunsakin191')
        ];

        $createDefaultOriginalUser = User::create($defaultOriginalUser);
        $createDefaultOriginalUser->attachRole(3);
    }
}

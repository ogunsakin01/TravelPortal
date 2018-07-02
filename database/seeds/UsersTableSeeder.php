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
                'id'                      =>  1,
                'email'                   => 'admin@travelportal.com',
                'password'                => bcrypt('admin'),
                'delete_status'           => 0,
                'profile_complete_status' => 0,
                'api_token'               => ''
            ],
            [
                'id'                      =>  2,
                'email'                   => 'agent@travelportal.com',
                'password'                => bcrypt('agent'),
                'delete_status'           => 0,
                'profile_complete_status' => 0,
                'api_token'               => ''
            ],
            [
                'id'                      =>  3,
                'email'                   => 'customer@travelportal.com',
                'password'                => bcrypt('customer'),
                'delete_status'           => 0,
                'profile_complete_status' => 0,
                'api_token'               => ''
            ],
            [
                'id'                      =>  4,
                'email'                   => 'first_agency@travelportal.com',
                'password'                => bcrypt('first_agency'),
                'delete_status'           => 0,
                'profile_complete_status' => 0,
                'api_token'               => ''
            ],
            [
                'id'                      =>  5,
                'email'                   => 'first_cooperate_customer@travelportal.com',
                'password'                => bcrypt('first_cooperate_customer'),
                'delete_status'           => 0,
                'profile_complete_status' => 0,
                'api_token'               => ''
            ],
        ];

        foreach($users as $serial => $user){
           $createUser = User::create($user);
           $createUser->attachRole($serial+1);
        }

        $defaultOriginalUser =  [
            'id'                          =>  6,
            'email'                       => 'ogunsakin191@gmail.com',
            'password'                    => bcrypt('ogunsakin191'),
            'delete_status'               => 0,
            'profile_complete_status'     => 0,
            'api_token'                   => ''
        ];

        $createDefaultOriginalUser = User::create($defaultOriginalUser);
        $createDefaultOriginalUser->attachRole(3);
    }
}

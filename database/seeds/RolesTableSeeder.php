<?php

use Illuminate\Database\Seeder;
use App\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'         => 'admin',
                'display_name' => 'Portal Admin',
                'description'  => 'General control of the entire system'
            ],
            [
                'name'         => 'agent',
                'display_name' => 'Portal Agent',
                'description'  => 'A customer that books for his/her personal customer'
            ],
            [
                'name'         => 'customer',
                'display_name' => 'Portal Customer',
                'description'  => 'A registered visitor, customer'
            ],
        ];

        foreach($roles as $serial => $role){
            Role::create($role);
        }
    }
}

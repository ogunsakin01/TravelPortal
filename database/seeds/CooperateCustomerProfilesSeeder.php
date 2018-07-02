<?php

use Illuminate\Database\Seeder;
use App\CooperateCustomerProfile;

class CooperateCustomerProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cooperateCustomerProfiles = [
            [
                'user_id'                                 => 6,
                'company_name'                            => 'First Cooperate Customer',
                'company_address'                         => 'No 10 lagos road, somewhere in Lagos',
                'cac_rc_number'                           => '2ASIJD12',
                'company_phone_number'                    => '09077777777',
                'company_email'                           => 'first_cooperate_customer@travelportal.com',
                'company_contact_person_email'            => 'first_cooperate_customer_person@travelportal.com',
                'company_contact_person_phone_number'     => '09066666666',
                'company_contact_person_address'          => 'No 12 Lagos road, somewhere in Lagos',
            ],
        ];

        foreach($cooperateCustomerProfiles as $serial => $cooperateCustomerProfile){
           CooperateCustomerProfile::create($cooperateCustomerProfile);
        }
    }
}

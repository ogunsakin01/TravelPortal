<?php

use Illuminate\Database\Seeder;
use App\AgencyProfile;

class AgencyProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencyProfiles = [
            [
                'user_id'                                 => 5,
                'company_name'                            => 'First Agency Travel Agency',
                'company_address'                         => 'No 1 lagos road, somewhere in Lagos',
                'cac_rc_number'                           => '2ASIJD12',
                'company_phone_number'                    => '09099999999',
                'company_email'                           => 'first_agency@travelportal.com',
                'company_contact_person_email'            => 'first_agency_contact_person@travelportal.com',
                'company_contact_person_phone_number'     => '09088888888',
                'company_contact_person_address'          => 'No 2 Lagos road, somewhere in Lagos',
            ],
        ];

        foreach($agencyProfiles as $serial => $agencyProfile){
            AgencyProfile::create($agencyProfile);
        }

    }
}

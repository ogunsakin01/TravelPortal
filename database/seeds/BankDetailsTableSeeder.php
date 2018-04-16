<?php

use Illuminate\Database\Seeder;
use App\BankDetail;

class BankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankDetails = [
            [
                'account_name'    =>'Touchcore Limited',
                'account_number'  =>'300290190',
                'bank_id'         =>'4',
                'bank_branch'     =>'Ikeja',
                'ifsc_code'       =>'44903',
                'pan'             =>'44904533',
                'status'          =>'1',
            ],
            [
                'account_name'    =>'Slick Nigeria Limited',
                'account_number'  =>'3434244432',
                'bank_id'         =>'10',
                'bank_branch'     =>'Lekki',
                'ifsc_code'       =>'44211',
                'pan'             =>'09878904',
                'status'          =>'1',
            ]
        ];

        foreach ($bankDetails as $key => $value){
            BankDetail::create($value);
        }
    }
}

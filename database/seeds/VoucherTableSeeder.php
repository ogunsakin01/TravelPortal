<?php

use Illuminate\Database\Seeder;
use App\Voucher;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vouchers = [
            [
                'id' => 1,
                'amount' => 10000,
                'code' => strtoupper(str_random('5')),
                'status' => 1
            ],
            [
                'id' => 2,
                'amount' => 67000,
                'code' => strtoupper(str_random('5')),
                'status' => 1
            ],
            [
                'id' => 3,
                'amount' => 34000,
                'code' => strtoupper(str_random('5')),
                'status' => 1
            ],
            [
                'id' => 4,
                'amount' => 13400,
                'code' => strtoupper(str_random('5')),
                'status' => 1
            ],
        ];
        foreach($vouchers as $serial => $voucher){
            Voucher::create($voucher);
        }
    }
}

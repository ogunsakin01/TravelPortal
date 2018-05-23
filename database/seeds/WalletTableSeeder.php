<?php

use Illuminate\Database\Seeder;
use App\Wallet;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallets = [
            [
              'id' => 1,
              'user_id' => 1,
              'balance' => 1000000000,
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'balance' => 500000000,
            ],
        ];

        foreach($wallets as $serial => $wallet){
           Wallet::create($wallet);
        }
    }
}

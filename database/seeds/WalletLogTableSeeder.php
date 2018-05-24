<?php

use Illuminate\Database\Seeder;
use App\WalletLog;

class WalletLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $walletLogs = [
            [
                'id'      => 1,
                'user_id' => 1,
                'amount'  => 1000000000,
                'status'  => 1,
                'type_id' => 1,
            ],
            [
                'id'      => 2,
                'user_id' => 2,
                'amount'  => 500000000,
                'status'  => 1,
                'type_id' => 1,
            ],
        ];

        foreach($walletLogs as $serial => $walletLog){
            WalletLog::create($walletLog);
        }
    }
}

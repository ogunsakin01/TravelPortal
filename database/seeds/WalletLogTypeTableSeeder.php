<?php

use Illuminate\Database\Seeder;
use App\WalletLogType;

class WalletLogTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logTypes = [
          [
              'id'   => 1,
              'name' => 'Admin Wallet Credit',
          ],
          [
               'id'   => 2,
               'name' => 'Admin Wallet Debit',
          ],
          [
                'id'   => 3,
                'name' => 'User Wallet Credit',
          ],
          [
                'id'   => 4,
                'name' => 'Hotel Payment Debit',
          ],
          [
                'id'   => 5,
                'name' => 'Flight Payment Debit',
          ],
          [
                'id'   => 6,
                'name' => 'Package Payment Debit',
          ],
          [
                'id'   => 7,
                'name' => 'Other Payment Debit',
          ],
          [
                'id'   => 8,
                'name' => 'Other Payment Credit',
          ],
        ];

        foreach($logTypes as $serial => $logType){
            WalletLogType::create($logType);
        }
    }
}

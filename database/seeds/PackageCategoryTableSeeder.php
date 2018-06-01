<?php

use Illuminate\Database\Seeder;
use App\PackageCategory;
class PackageCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $package_categories = [
          [
              'category'=>'Food & Culinary'
          ],
          [
              'category'=>'Fashion & Shopping'
          ],
          [
              'category'=>'Music & Festival'
          ],
          [
              'category'=>'History & Culture'
          ],
          [
              'category'=>'Sports & Nature'
          ],
          [
              'category'=>'Entertain & Gamble'
          ],
          [
              'category'=>'Health & Beauty'
          ]
      ];

      PackageCategory::truncate();
      foreach ($package_categories as $key => $value){
        PackageCategory::create($value);
      }
    }
}

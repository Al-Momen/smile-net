<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price_currencie = [
            [
                'name' => 'United States Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => now(),
            ],
            
        ];


        DB::table('price_currencies')->insert($price_currencie);
    }
}

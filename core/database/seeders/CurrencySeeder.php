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
        $currency_data = [
            [
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'currency_fullname' => 'United States Dollar',
                'currency_type' => '1',
                'rate' => '1.00',
                'created_at' => now(),
            ],
            [
                'currency_code' => 'GBP',
                'currency_symbol' => '£',
                'currency_fullname' => 'Great British Pound',
                'currency_type' => '1',
                'rate' => '0.81',
                'created_at' => now(),
            ],
            [
                'currency_code' => 'NGN',
                'currency_symbol' => '₦',
                'currency_fullname' => 'Nigerian Naira',
                'currency_type' => '1',
                'rate' => '415.13',
                'created_at' => now(),
            ],
            [
                'currency_code' => 'BTC',
                'currency_symbol' => '₿',
                'currency_fullname' => 'Bitcoin',
                'currency_type' => '2',
                'rate' => '0.00',
                'created_at' => now(),
            ],
            [
                'currency_code' => 'LTC',
                'currency_symbol' => 'Ł',
                'currency_fullname' => 'Litecoin',
                'currency_type' => '2',
                'rate' => '0.02',
                'created_at' => now(),
            ]
            
        ];


        DB::table('currencies')->insert($currency_data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'pages' => 'home',
                'created_at' => now(),
            ],
            [
                'pages' => 'pricing',
                'created_at' => now(),
            ],
            [
                'pages' => 'events',
                'created_at' => now(),
            ],
            [
                'pages' => 'plan',
                'created_at' => now(),
            ],
            [
                'pages' => 'voting',
                'created_at' => now(),
            ],
            [
                'pages' => 'magazine',
                'created_at' => now(),
            ],
            [
                'pages' => 'magazine-details',
                'created_at' => now(),
            ],
            [
                'pages' => 'live-now',
                'created_at' => now(),
            ],
            [
                'pages' => 'music',
                'created_at' => now(),
            ],
            [
                'pages' => 'smile-tv',
                'created_at' => now(),
            ],
            [
                'pages' => 'news',
                'created_at' => now(),
            ],
            
            

        ];

        DB::table('admin_pages')->insert($pages);
    }
}

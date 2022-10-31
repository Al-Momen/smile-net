<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_social_link = [
            [
                'email' => 'info@example.com',
                'phone' => '+ 1-234-567-890',
                'address' => 'Medino, Kitaniya Road , USA',
                'fb_link' => 'https://www.facebook.com/',
                'twitter_link' => 'https://twitter.com/',
                'instragram_link' => 'https://www.instagram.com/',
                'linkedin_link' => 'https://www.linkedin.com/',
                'created_at' => now(),
            ],

        ];


        DB::table('admin_social_links')->insert($admin_social_link);
    }
}

<?php

namespace Database\Seeders;

use App\Models\AdminMailSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $adminMail = new AdminMailSetting();
         $adminMail->mail_transport = 'smtp';
         $adminMail->mail_host = 'smtp.mailtrap.io';
         $adminMail->mail_port = '2525';
         $adminMail->mail_username = 'cd4124b03fc58e';
         $adminMail->mail_password = '065aa527d6a73d';
         $adminMail->mail_encryption = 'tls';
         $adminMail->mail_from = ' hello@gmail.com';
         $adminMail->save();
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename')->nullable();
            $table->string('site_sub_title')->nullable();
            $table->tinyInteger('dark')->nullable();
            $table->string('cur_text')->nullable();
            $table->string('cur_sym')->nullable();
            $table->string('email_from')->nullable();
            $table->string('sms_api')->nullable();
            $table->string('base_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('component_color')->nullable();
            $table->json('mail_config')->nullable();
            $table->json('sms_config')->nullable();
            $table->tinyInteger('ev')->nullable();
            $table->tinyInteger('en')->nullable();
            $table->tinyInteger('sv')->nullable();
            $table->tinyInteger('sn')->nullable();
            $table->string('otp_expiration')->nullable();
            $table->tinyInteger('otp_verification')->nullable();
            $table->string('timezone')->nullable();
            $table->tinyInteger('force_ssl')->nullable();
            $table->tinyInteger('secure_password')->nullable();
            $table->tinyInteger('agree')->nullable();
            $table->tinyInteger('registration')->nullable();
            $table->tinyInteger('withdraw_status')->nullable();
            $table->tinyInteger('deposit_status')->nullable();
            $table->tinyInteger('kyc_verification')->nullable();
            $table->tinyInteger('devlopment_mode')->nullable();
            $table->string('active_template')->nullable();
            $table->text('email_template')->nullable();
            $table->string('fiat_currency_api')->nullable();
            $table->string('crypto_currency_api')->nullable();
            $table->text('qr_template')->nullable();
            $table->string('sys_version')->nullable();
            $table->string('cron_run')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}

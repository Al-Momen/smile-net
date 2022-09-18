<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('ev')->nullable()->comment('0 = email unverified, 1 = email verifieed');
            $table->tinyInteger('sv')->nullable()->comment('0 = sms unverified, 1 = sms verified');
            $table->string('ver_code', 1000)->nullable()->comment('stores verification code');
            $table->tinyInteger('ts')->nullable()->comment('0: 2fa off, 1: 2fa on');
            $table->tinyInteger('tv')->nullable()->comment('0: 2fa unverified, 1: 2fa verified');
            $table->string('tsc')->nullable();
            $table->decimal('balance', 8, 2)->nullable();
            $table->tinyInteger('kyc_status')->default(0);
            $table->text('kyc_info')->nullable();
            $table->string('kyc_reject_reasons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ev');
            $table->dropColumn('sv');
            $table->dropColumn('ver_code');
            $table->dropColumn('ts');
            $table->dropColumn('tv');
            $table->dropColumn('tsc');
            $table->dropColumn('balance');
            $table->dropColumn('kyc_status');
            $table->dropColumn('kyc_info');
            $table->dropColumn('kyc_reject_reasons');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('country_code')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->integer('ref_by')->unsigned();
            $table->decimal('balance');
            $table->string('password');
            $table->string('image')->nullable();
            $table->text('address')->comment('contains full address');
            $table->tinyInteger('status')->nullable()->comment('1=>success, 2=>pending, 3=>cancel')->default(0);
            $table->tinyInteger('kyc_status')->nullable()->comment('1=>success, 2=>pending, 3=>cancel')->default(0);
            $table->text('kyc_info')->nullable();
            $table->string('kyc_reject_reasons')->nullable();
            $table->tinyInteger('ev')->nullable()->comment('0: email unverified, 1: email verified')->default(0);
            $table->tinyInteger('sv')->nullable()->comment('0: sms unverified, 1: sms verified')->default(0);
            $table->string('ver_code')->nullable()->comment('stores verification code')->default(0);
            $table->timestamp('ver_code_send_at')->nullable();
            $table->tinyInteger('ts')->nullable()->comment('0: 2fa off, 1: 2fa on')->default(0);
            $table->tinyInteger('tv')->nullable()->comment('0: 2fa unverified, 1: 2fa verified')->default(1);
            $table->string('tsc')->nullable()->comment('0: 2fa unverified, 1: 2fa verified')->default(1);
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
        Schema::dropIfExists('agents');
    }
}

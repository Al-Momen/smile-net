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
        Schema::create('admin_paypal_getways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('client_id');
            $table->string('secret_key');
            $table->string('fixed_charge');
            $table->decimal('percent_charge');
            $table->string('app_id')->nullable();
            $table->string('mode');
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
        Schema::dropIfExists('admin_paypal_getways');
    }
};

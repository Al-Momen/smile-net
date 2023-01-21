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
        Schema::create('admin_manual_getway', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('currency_id');
            $table->string('name');
            $table->string('alias');
            $table->integer('code');
            $table->string('image');
            $table->string('minium_amount');
            $table->string('maximum_amount');
            $table->string('fixed_charge');
            $table->string('percent_charge');
            $table->longText('description');
            $table->longText('user_data');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('admin_manual_getway');
    }
};

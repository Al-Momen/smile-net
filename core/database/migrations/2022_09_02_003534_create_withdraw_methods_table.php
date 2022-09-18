<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('currencies');
            $table->text('user_guards');
            $table->decimal('min_limit')->comment('0.00000000');
            $table->decimal('max_limit')->comment('0.00000000');
            $table->decimal('fixed_charge')->comment('0.00000000');
            $table->decimal('percent_charge')->comment('0.00000000');
            $table->text('user_data')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('withdraw_methods');
    }
}

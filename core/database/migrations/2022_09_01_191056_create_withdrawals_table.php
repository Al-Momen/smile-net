<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->integer('method_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('currency')->nullable();
            $table->integer('wallet_id')->unsigned();
            $table->string('user_type')->nullable();
            $table->decimal('amount')->nullable()->default(0.00000000);
            $table->decimal('charge')->nullable()->default(0.00000000);
            $table->decimal('final_amount')->nullable()->default(0.00000000);
            $table->decimal('after_charge')->nullable()->default(0.00000000);
            $table->decimal('rate')->nullable();
            $table->text('withdraw_information')->nullable();
            $table->string('trx')->nullable();
            $table->tinyInteger('status')->nullable()->comment('1=>success, 2=>pending, 3=>cancel')->default(0);
            $table->text('admin_feedback')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}

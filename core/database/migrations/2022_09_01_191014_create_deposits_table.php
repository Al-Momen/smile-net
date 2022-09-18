<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('user_type')->nullable()->default("USER");
            $table->integer('wallet_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('method_code')->nullable();

            $table->decimal('amount')->nullable()->default(0.00000000);
            $table->string('method_currency')->nullable();
            $table->decimal('charge')->nullable()->default(0.00000000);
            $table->decimal('rate')->nullable();
            $table->decimal('final_amo')->nullable()->default(0.00000000);

            $table->text('detail')->nullable();
            $table->decimal('btc_amo')->nullable()->default(0.00000000);
            $table->string('btc_wallet')->nullable();

            $table->string('trx')->nullable();
            $table->string('try')->nullable();

            $table->tinyInteger('status')->nullable()->comment('1=>success, 2=>pending, 3=>cancel')->default(0);
            $table->tinyInteger('from_api')->nullable()->default(0);
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
        Schema::dropIfExists('deposits');
    }
}

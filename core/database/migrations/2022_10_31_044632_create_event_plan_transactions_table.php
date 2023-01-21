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
        Schema::create('event_plan_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("event_plan_id");
            $table->unsignedBigInteger("author_event_id");
            $table->unsignedBigInteger("buy_user_id");
            $table->string("paid_price");
            $table->string("coupon")->nullable();
            $table->string("payment_getway");
            $table->decimal("discount")->nullable()->default(0);
            $table->string("transaction_id")->nullable()->unique();
            $table->string("sold")->default(0);
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
        Schema::dropIfExists('event_plan_transactions');
    }
};

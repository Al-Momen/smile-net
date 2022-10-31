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
        Schema::create('pricing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pricing_id");
            $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists('pricing_details');
    }
};

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
        Schema::create('ticket_type_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ticket_type_id");
            $table->unsignedBigInteger("user_id");
            $table->string("paid_price");
            $table->string("coupon")->nullable();
            $table->string("payment_getway");
            $table->string("method_code")->nullable();
            $table->string("method_currency")->nullable();
            $table->decimal("discount")->nullable()->default(0);
            $table->string("transaction_id")->nullable()->unique();
            $table->tinyInteger("status")->default(0);
            $table->decimal("charge")->nullable();
            $table->decimal("rate")->nullable();
            $table->decimal("final_amo")->nullable();
            $table->string("sold")->default(0);
            $table->string("detail")->default(0);
            $table->string("slug")->nullable();
            $table->string("reject")->nullable();
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
        Schema::dropIfExists('ticket_type_details');
    }
};

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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("price_id");
            $table->string("title");
            $table->string("price");
            $table->string("pdf")->nullable();
            $table->longText("description");
            $table->string("image");
            $table->string("tag")->nullable();
            $table->tinyInteger("status")->nullable()->default(0);
            $table->string("slug")->nullable();
            $table->string("coupon")->nullable();
            $table->decimal("discount")->nullable();
            $table->string("file");
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
        Schema::dropIfExists('books');
    }
};

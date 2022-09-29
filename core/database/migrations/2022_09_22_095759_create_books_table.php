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
            $table->string("category_id");
            $table->string("title");
            $table->string("pdf")->nullable();
            $table->longText("description");
            $table->string("image");
            $table->string("tag")->nullable();
            $table->tinyInteger("status")->nullable()->default(0);
            $table->string("slug")->nullable();
            $table->string("price");
            $table->string("coupon")->nullable();
            $table->decimal("discount")->nullable();
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

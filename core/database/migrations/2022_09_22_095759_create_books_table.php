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
            $table->unsignedBigInteger("author_book_id");
            $table->string("author_book_type");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("price_id");
            $table->string("price");
            $table->string("paid_price")->nullable()->default(0);
            $table->string("title");
            $table->string("image");
            $table->string("file");
            $table->string("tag")->nullable();
            $table->longText("description");
            $table->tinyInteger("status")->nullable()->default(0);
            $table->string("slug")->nullable();
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

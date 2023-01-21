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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("author_event_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("price_currency_id");
            $table->string("title");
            $table->longText("description");
            $table->string("image");
            $table->string("tag")->nullable();
            $table->tinyInteger("status")->nullable()->default(0);
            $table->tinyInteger("sold")->nullable()->default(0);
            $table->string("slug")->nullable();
            $table->date("start_date");
            $table->date("end_date");
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
        Schema::dropIfExists('events');
    }
};

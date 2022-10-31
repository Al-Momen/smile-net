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
        Schema::create('admin_live_tv_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("live_tv_id");
            $table->unsignedBigInteger("user_id");
            $table->string("like")->nullable();
            $table->string("dislike")->nullable();;
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
        Schema::dropIfExists('admin_live_tv_likes');
    }
};

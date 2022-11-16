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
        Schema::create('new_items_movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_type_id');    
            $table->unsignedBigInteger('admin_id');    
            $table->string('name');
            $table->string('category');
            $table->longText('description');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('image');
            $table->string('mp4');
            $table->string('slug');
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
        Schema::dropIfExists('new_items_movies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('act')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->text('script')->nullable();
            $table->text('shortcode')->nullable();
            $table->text('support')->nullable()->comment('Help section');
            $table->tinyInteger('status')->nullable()->comment('1=>enable, 2=>disable	');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('extensions');
    }
}

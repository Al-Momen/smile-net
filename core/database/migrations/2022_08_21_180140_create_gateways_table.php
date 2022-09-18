<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('alias');
            $table->string('image');
            $table->tinyInteger('status')->nullable();
            $table->text('gateway_parameters');
            $table->text('supported_currencies');
            $table->tinyInteger('crypto')->nullable();
            $table->text('extra')->nullable();
            $table->text('description')->nullable();
            $table->text('input_form')->nullable();
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
        Schema::dropIfExists('gateways');
    }
}

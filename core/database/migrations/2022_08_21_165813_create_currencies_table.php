<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code');
            $table->string('currency_symbol');
            $table->string('currency_fullname');
            $table->string('currency_type')->comment('1 => fiat, 2 => crypto');
            $table->float('rate')->nullable();
            $table->tinyInteger('status')->comment('1 => active, 0 => inactive')->default(1);
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
        Schema::dropIfExists('currencies');
    }
}


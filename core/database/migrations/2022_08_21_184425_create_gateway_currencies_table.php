<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewayCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('currency')->nullable();
            $table->string('symbol')->nullable();
            $table->integer('method_code')->nullable();
            $table->string('gateway_alias')->nullable();
            $table->decimal('min_amount', 24, 2)->nullable( );
            $table->decimal('max_amount', 24, 2)->nullable( );
            $table->decimal('percent_charge', 24, 2)->nullable( );
            $table->decimal('fixed_charge', 24, 2)->nullable( );
            $table->decimal('rate', 24, 2)->nullable( );
            $table->string('image')->nullable( );
            $table->text('gateway_parameter')->nullable( );
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
        Schema::dropIfExists('gateway_currencies');
    }
}

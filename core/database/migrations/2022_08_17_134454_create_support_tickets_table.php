<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('FK users table');
            $table->string('name');
            $table->string('email');
            $table->string('ticket');
            $table->string('subject');
            $table->tinyInteger('status')->comment("0: Open, 1: Answered, 2: Replied, 3: Closed");
            $table->tinyInteger('priority')->comment("1 = Low, 2 = medium, 3 = heigh")->default(0);
            $table->dateTime('last_reply')->nullable();
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
        Schema::dropIfExists('support_tickets');
    }
}

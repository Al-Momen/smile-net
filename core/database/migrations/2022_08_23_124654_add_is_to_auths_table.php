<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsToAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auths', function (Blueprint $table) {
            $table->tinyInteger('ev')->nullable()->comment('0 = email unverified, 1 = email verifieed');
            $table->tinyInteger('sv')->nullable()->comment('0 = sms unverified, 1 = sms verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auths', function (Blueprint $table) {
            $table->dropColumn('ev');
            $table->dropColumn('sv');
        });
    }
}

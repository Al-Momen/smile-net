<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('verified_code')->nullable()->unique();
            $table->tinyInteger('status')->default(0)->comment("0==unverified, 1==verified"); 
            $table->string('country')->nullable();
            $table->string('photo')->nullable();
            $table->string('user_name')->nullable();
            $table->string('follower')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->string('password');
            $table->tinyInteger('access')->default(0)->comment("0==Active, 1==Banned"); 
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
        Schema::dropIfExists('general_users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('phone');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->integer('dbirth')->nullable();
            $table->integer('mbirth')->nullable();
            $table->integer('ybirth')->nullable();
            $table->integer('age')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1=male, 2=female');
            $table->tinyInteger('register_channel')->nullable()->comment('1=2ways, 2=microsite');
            $table->integer('total_point')->default(0);
            $table->unique(array('phone','register_channel'));
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 10);
            $table->tinyInteger('status')->default(1)->comment('1=ยังไม่ใช้, 2=ใช้แล้ว');
            $table->string('phone_number')->nullable();
            $table->tinyInteger('type')->comment('รสชาติ');
            $table->tinyInteger('register_channel')->nullable()->comment('1=2ways, 2=microsite');
            $table->dateTime('created_at')->default(Carbon::now());
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}

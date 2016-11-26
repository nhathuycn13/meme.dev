<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePNKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('PNK', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('NK_status_id')->defautl(1);
            $table->unsignedInteger('user_id');
            $table->string('description')->nullable();
//            $table->string('shipping')->default(0);
//            $table->unsignedInteger('tax')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('NK_status_id')->references('id')->on('NK_status');

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
        Schema::dropIfExists('PNK');
    }
}

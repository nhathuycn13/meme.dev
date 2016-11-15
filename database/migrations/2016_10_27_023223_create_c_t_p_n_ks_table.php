<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCTPNKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CTPNK', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('PNK_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('qty')->default(1);
            $table->string('price')->nullable();

            $table->foreign('PNK_id')
                    ->references('id')
                    ->on('PNK');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
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
        Schema::dropIfExists('CTPNK');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->boolean('isOrder')->default('0');
            $table->unsignedInteger('order_status');
//            $table->unsignedInteger('shipping')->default(0);
            $table->string('description')->nullable();
            $table->unsignedInteger('payment_type_id');
            $table->unsignedInteger('invoice_id')->nullable();
            $table->float('tax');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('orders');
    }
}

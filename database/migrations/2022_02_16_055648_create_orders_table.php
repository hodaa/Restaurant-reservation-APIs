<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables');

            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->integer('waiter_id');
            $table->integer('total'); 
            $table->integer('paid');
            $table->timestamp('date');
           


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
};

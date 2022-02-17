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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->foreign('table_id')->references('id')->on('tables');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->time('from_time');
            $table->time('to_time');

            $table->tinyInteger('status');
        

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
        Schema::dropIfExists('reservations');
    }
};

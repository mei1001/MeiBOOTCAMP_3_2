<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
             $table->timestamps();
            $table->integer('DataCustomer_id')->unsigned();
            $table->foreign('DataCustomer_id')->references('id')->on('DataCustomer');
            $table->integer('Room_id')->unsigned();
            $table->foreign('Room_id')->references('id')->on('room_list');
            $table->date('checkin');
            $table->date('checkOut');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}

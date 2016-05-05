<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('billing', function (Blueprint $table) {
            $table->integer('bid',compact(10));
            $table->integer('pid',compact(10));
            $table->integer('uid',compact(10));
            $table->string('card_name',150);
            $table->bigInteger('card_no')->length(30);
            $table->date('exp_date');
            $table->integer('verification_no',30);
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
        //
        Schema::drop('billing');
    }
}

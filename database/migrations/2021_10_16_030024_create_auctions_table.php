<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('description')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->nullable();
            $table->json('images')->nullable();
            $table->string('category_id')->nullable();
            $table->string('starting_price')->nullable();
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
        Schema::dropIfExists('auctions');
    }
}

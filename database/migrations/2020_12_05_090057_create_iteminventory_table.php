<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIteminventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iteminventory', function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('donor_id');
            $table->string('item_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('condition')->nullable();
            $table->timestamps();

            $table->foreign('donor_id')->references('donor_id')->on('donor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iteminventory');
    }
}

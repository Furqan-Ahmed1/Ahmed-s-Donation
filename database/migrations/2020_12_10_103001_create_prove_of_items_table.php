<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveOfItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prove_for_items', function (Blueprint $table) {
            $table->unsignedBigInteger('recipient_id');
            $table->string('Item_Name');
            $table->integer('Quantity');
            $table->string('Electric_Bill') ;
            $table->string('Gas_Bill') ;
            $table->string('Finantial_statement') ;
            $table->float('Conclusion_rating');
            $table->integer('Approval');

            $table->foreign('recipient_id')->references('recipient_id')->on('recipient')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prove_of_items');
    }
}

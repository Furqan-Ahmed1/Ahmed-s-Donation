<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveOfBloodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Prove_for_blood', function (Blueprint $table) {
            $table->unsignedBigInteger('recipient_id');
            $table->string('Blood_Group');
            $table->integer('Quantity_ltr');
            $table->string('Medical_Report')->nullable() ;
            $table->float('Conclusion_rating')->nullable();
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
        Schema::dropIfExists('prove_of_blood');
    }
}

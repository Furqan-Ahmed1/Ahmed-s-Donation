<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodinventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloodinventory', function (Blueprint $table) {
            $table->id('blood_id');
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('report_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('donor_id')->references('donor_id')->on('donor')->onDelete('cascade');

            $table->foreign('report_id')->references('report_id')->on('medicalreport')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bloodinventory');
    }
}

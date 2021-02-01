<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganinventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organinventory', function (Blueprint $table) {
            $table->id('organ_id');
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('report_id');
            $table->string('organ_name');
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
        Schema::dropIfExists('organinventory');
    }
}

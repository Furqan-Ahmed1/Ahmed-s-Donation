<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalreportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalreport', function (Blueprint $table) {
            $table->id('report_id');
            $table->unsignedBigInteger('donor_id');
            $table->string('report_type');
            $table->string('blood_group')->nullable();
            $table->string('compatibility')->nullable();
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
        Schema::dropIfExists('medicalreport');
    }
}

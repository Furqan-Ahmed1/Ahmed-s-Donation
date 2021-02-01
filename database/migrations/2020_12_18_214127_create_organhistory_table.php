<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganhistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organhistory', function (Blueprint $table) {
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('organ_name')->nullable();
            $table->unsignedBigInteger('donor_report_id');
            $table->timestamps();

            $table->foreign('donor_id')->references('donor_id')->on('donor')->onDelete('cascade');
            $table->foreign('recipient_id')->references('recipient_id')->on('recipient')->onDelete('cascade');
            $table->foreign('donor_report_id')->references('report_id')->on('medicalreport')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organhistory');
    }
}

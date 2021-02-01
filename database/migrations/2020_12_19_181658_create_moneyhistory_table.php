<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyhistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneyhistory', function (Blueprint $table) {
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();

            $table->foreign('donor_id')->references('donor_id')->on('donor')->onDelete('cascade');
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
        Schema::dropIfExists('moneyhistory');
    }
}

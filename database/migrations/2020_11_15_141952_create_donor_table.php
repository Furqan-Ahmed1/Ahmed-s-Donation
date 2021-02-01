<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor', function (Blueprint $table) {
            $table->id('donor_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('date_of_birth')->nullable();
            $table->string('gender');
            $table->string('phone_no');
            $table->string('address');
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('cnic')->unique();
            $table->string('card_no')->nullable();
            $table->string('cvv')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('donor');
    }
}

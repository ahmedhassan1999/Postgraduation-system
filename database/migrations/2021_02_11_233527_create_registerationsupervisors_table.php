<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterationsupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerationsupervisors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRegistrationF');
            $table->unsignedBigInteger('idSupervisorF');
            $table->string('registrationDate',400)->nullable();
            $table->string('cancelationDate',400)->nullable();
            $table->string('currentState', 50)->nullable();
            $table->integer('stillExist')->nullable();
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
        Schema::dropIfExists('registerationsupervisors');
    }
}

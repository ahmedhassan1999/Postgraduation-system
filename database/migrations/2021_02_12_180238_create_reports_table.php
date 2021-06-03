<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('idRegistrationF');
            $table->unsignedBigInteger('idRefereedF');
            $table->string('URLReport', 400)->nullable();
            $table->string('reportState', 40)->nullable();
            $table->string('dateReport',400)->nullable();
            $table->bigIncrements('idReport');
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
        Schema::dropIfExists('reports');
    }
}

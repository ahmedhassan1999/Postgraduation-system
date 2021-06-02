<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->bigIncrements('idSupervisor');
            $table->string('arabicName', 50)->nullable();
            $table->string('englishName', 50)->nullable();
            $table->string('university', 50)->nullable();
            $table->string('faculty', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->string('specialization', 50)->nullable();
            $table->string('nationalityId', 20)->nullable();
            $table->string('nationality', 50)->nullable();
            $table->unsignedBigInteger('idDegreeF');
            $table->string('gender', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobile', 20)->nullable();
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
        Schema::dropIfExists('supervisors');
    }
}

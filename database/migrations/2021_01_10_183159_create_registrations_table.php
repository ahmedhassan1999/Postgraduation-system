<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('idRegistration');
            $table->unsignedBigInteger('idSF');
            $table->string('arabicTitle', 100);
            $table->string('englishTitle', 100);
            $table->string('requiredCourses', 100)->nullable();
            $table->double('toeflGrade')->nullable();
            $table->string('departmentApprovalDateRegistration')->nullable();
            $table->string('facultyApprovalDateRegistration')->nullable();
            $table->string('universitydepartmentApprovalDateRegistration')->nullable();
            $table->string('committeeytApprovalDateRegistration')->nullable();
            $table->string('formDate')->nullable();
            $table->string('currentState', 50)->nullable();
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
        Schema::dropIfExists('registrations');
    }
}

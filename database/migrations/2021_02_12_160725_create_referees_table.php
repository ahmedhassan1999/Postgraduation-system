<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->bigIncrements('idRefereed');
            $table->string('arabicName', 50);
            $table->string('englishName', 50)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('university', 50)->nullable();
            $table->string('faculty', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->unsignedBigInteger('idDegreeF')->nullable();;
            $table->string('nationality', 50)->nullable();
            $table->string('specialization', 50)->nullable();
            $table->string('nationalityId', 15)->nullable();
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
        Schema::dropIfExists('referees');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginToSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->foreign('idDegreeF')->references('idUniversityPosition')->on('universitypositions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            //
        });
    }
}

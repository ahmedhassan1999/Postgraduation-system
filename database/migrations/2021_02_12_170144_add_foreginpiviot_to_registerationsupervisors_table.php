<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginpiviotToRegisterationsupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registerationsupervisors', function (Blueprint $table) {
            $table->foreign('idRegistrationF')->references('idRegistration')->on('registrations')->onDelete('cascade');
            $table->foreign('idSupervisorF')->references('idSupervisor')->on('supervisors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registerationsupervisors', function (Blueprint $table) {
            //
        });
    }
}

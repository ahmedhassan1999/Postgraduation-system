<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousstudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previousstudies', function (Blueprint $table) {
            $table->unsignedBigInteger('idSF')->nullable();
            $table->string('degree',50)->nullable();
            $table->string('faculty',50)->nullable();
            $table->string('university',50)->nullable();
            $table->date('dateObtained')->nullable();
            $table->string('specialization',50)->nullable();
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
        Schema::dropIfExists('previousstudies');
    }
}

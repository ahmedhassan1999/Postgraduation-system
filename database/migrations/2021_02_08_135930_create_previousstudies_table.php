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
            $table->unsignedBigInteger('idSF');
            $table->string('degree', 50);
            $table->string('faculty', 50);
            $table->string('university', 50);
            $table->date('dateObtained');
            $table->string('specialization', 50);
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

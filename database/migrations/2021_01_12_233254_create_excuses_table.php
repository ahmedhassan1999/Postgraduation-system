<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excuses', function (Blueprint $table) {
            $table->id('idExcuse');
            $table->string('excuseDate',400);
            $table->string('cancelDate',400)->nullable();
            $table->string('submittedDocURL', 400)->nullable();
            $table->string('extendedPeriodDocURL', 400)->nullable();
            $table->integer('numberMonthExtendedPeriod')->unsigned()->nullable();
            $table->string('content', 300);
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
        Schema::dropIfExists('excuses');
    }
}

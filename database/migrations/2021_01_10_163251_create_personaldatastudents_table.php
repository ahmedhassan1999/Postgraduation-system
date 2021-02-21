<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaldatastudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personaldatastudents', function (Blueprint $table) {
            $table->bigIncrements('idS');
            $table->string('image',1000)->nullable();
            $table->string('englishName')->nullable();
            $table->string('arabicName');
            $table->string('birthdateSource')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('jobArabic')->nullable();
            $table->string('jobEnglish')->nullable();
            $table->string('jobAdd')->nullable();
            $table->string('Add')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('nationalityId')->nullable();
            $table->string('gender')->nullable();
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
        Schema::dropIfExists('personaldatastudents');
    }
}

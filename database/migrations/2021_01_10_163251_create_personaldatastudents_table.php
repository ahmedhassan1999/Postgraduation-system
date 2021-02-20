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
            $table->string('englishName', 50)->nullable();
            $table->string('arabicName', 50);
            $table->string('birthdateSource', 20)->nullable();
            $table->string('birthdate')->nullable();
            $table->string('jobArabic', 50)->nullable();
            $table->string('jobEnglish', 50)->nullable();
            $table->string('jobAdd', 100)->nullable();
            $table->string('Add', 100)->nullable();
            $table->string('religion', 10)->nullable();
            $table->string('nationality', 20)->nullable();
            $table->string('email', 100);
            $table->string('mobile', 20)->nullable();
            $table->string('nationalityId', 20)->nullable();
            $table->string('gender', 5)->nullable();
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

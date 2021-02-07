<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\Personaldatastudent;
use App\Models\Supervisor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    //protected $model = \App\Models\Registration::class;
    public function run()
    {
        /* DB::table('registrations')->insert([
            'englishTitle' => Str::random(10),
            'requiredCourses' => Str::random(10),
        ]);*/
        //this work for factory
        // \App\Models\Personaldatastudent::factory()->count(3)->create();
        //\App\Models\Registration::factory()->count(3)->create();
        // this work for one to many
        $person = Personaldatastudent::factory()
            ->has(Registration::factory()->count(3), 'register')
            ->create();
        // \App\Models\Supervisor::factory()->count(3)->create();
        /*$user = Registration::factory()
      ->has(
        Supervisor::factory()->count(3),'supervisors'
      )
      ->create();*/

        //  $this->call(RegistrationTableSeeder::class);
        //$this->call( PersonaldatastudentTableSeeder::class);


    }
}

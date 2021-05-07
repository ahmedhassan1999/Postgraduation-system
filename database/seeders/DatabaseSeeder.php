<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\Personaldatastudent;
use App\Models\Supervisor;
use App\Models\Universityposition;
use App\Models\Referee;
use App\Models\Previousstudie;
use App\Models\Department;
use App\Models\Excuse;
use App\Models\Payment;
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
      //   \App\Models\Personaldatastudent::factory()->count(3)->create();
     // \App\Models\Personaldatastudent::factory()->count(3)->create();
        // \App\Models\Previousstudie::factory()->count(1)->create();
     //   \App\Models\Department::factory()->count(5)->create();
       // \App\Models\StudyType::factory()->count(1)->create();
        // \App\Models\Registration::factory()->count(1)->create();

        // \App\Models\Universityposition::factory()->count(3)->create();
        // \App\Models\Referee::factory()->count(3)->create();
        // \App\Models\Supervisor::factory()->count(3)->create();
        // // this work for one to many
        /* $person1 = Personaldatastudent::factory()
             ->has(Registration::factory()->count(3), 'registers')
             ->create();*/
        // $person111 = Personaldatastudent::factory()
        //     ->has(Previousstudie::factory()->count(3), 'prevstudies')
        //     ->create();
      /*  $person111 = Registration::factory()
             ->has(Excuse::factory()->count(2), 'excuses')
             ->create();*/
            /* $person111 = Registration::factory()
             ->has(Payment::factory()->count(3), 'payments')
             ->create();*/

        // $person2 = Universityposition::factory()
        //     ->has(Referee::factory()->count(3), 'refrees')
        //     ->create();
        // $person3 = Universityposition::factory()
        //     ->has(Supervisor::factory()->count(3), 'supervisors')
        //     ->create();


        // $user1 = Registration::factory()
        //     ->has(
        //         Supervisor::factory()->count(3),
        //         'supervisors'
        //     )
        //     ->create();
        // $user11 = Supervisor::factory()
        //     ->has(
        //         Registration::factory()->count(3),
        //         'registrions'
        //     )
        //     ->create();
      /*   $user2 = Registration::factory()
            ->has(
                Referee::factory()->count(3),
                'refress'
             )
           ->create();*/
       /* $user22 = Referee::factory()
             ->has(
                 Registration::factory()->count(3),
                 'register'
             )
            ->create();*/

        //  $this->call(RegistrationTableSeeder::class);
        //$this->call( PersonaldatastudentTableSeeder::class);

    }
}

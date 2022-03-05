<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        City::factory(30)->create();
        Patient::factory(30)->create();
        Specialite::factory(30)->create();
        Doctor::factory(30)->create();
        Appointment::factory(30)->create();
    }
}

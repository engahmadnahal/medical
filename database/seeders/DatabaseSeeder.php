<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialite;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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



        /*

                Before Run this Seeder , Run Role And Permission Seeder before


        */
        City::factory(30)->create();
        Patient::factory(30)->create();
        Specialite::factory(30)->create();
        Doctor::create([
            'first_name'=>"Super",
            'last_name'=>"Admin",
            'mobile'=>"Admin",
            'gender'=>"M",
            'work_id'=>"000000",
            'degree'=>"master",
            'birth_date'=>"2022-03-02",
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email'=>"admin@admin.com",
            'cv'=>"Admin",
            'avater'=>'login.png',
            'start_time'=>"2022-03-16 20:29:30.000000",
            'end_time'=>"2022-03-16 20:29:30.000000",
            'city_id'=>1,
            'specialite_id'=>1,
        ])->syncRoles(1);
        $role = Role::where('id',1)->first();
        $role->givePermissionTo(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
        Doctor::factory(30)->create();
        Appointment::factory(30)->create();
    }
}

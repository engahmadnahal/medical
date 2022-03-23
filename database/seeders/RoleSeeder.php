<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name"=>"Super-Admin","guard_name"=>"admin"]);
        Role::create(["name"=>"Human Resource","guard_name"=>"admin"]);
        Role::create(["name"=>"Asesstant","guard_name"=>"admin"]);


    }
}

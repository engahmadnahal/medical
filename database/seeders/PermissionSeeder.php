<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name"=>"Create-City","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-City","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-City","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Citis","guard_name"=>"admin"]);

        Permission::create(["name"=>"Create-Patent","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-Patent","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-Patent","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Patents","guard_name"=>"admin"]);

        Permission::create(["name"=>"Create-Appoinment","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-Appoinment","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-Appoinment","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Appoinments","guard_name"=>"admin"]);

        Permission::create(["name"=>"Create-Doctor","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-Doctor","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-Doctor","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Doctors","guard_name"=>"admin"]);

        Permission::create(["name"=>"Create-Specialite","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-Specialite","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-Specialite","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Specialites","guard_name"=>"admin"]);

        Permission::create(["name"=>"Create-Role","guard_name"=>"admin"]);
        Permission::create(["name"=>"Read-Roles","guard_name"=>"admin"]);
        Permission::create(["name"=>"Delete-Role","guard_name"=>"admin"]);
        Permission::create(["name"=>"Update-Role","guard_name"=>"admin"]);

        // User Permission
        Permission::create(["name"=>"Create-Patent","guard_name"=>"user"]);
        Permission::create(["name"=>"Update-Patent","guard_name"=>"user"]);
        Permission::create(["name"=>"Delete-Patent","guard_name"=>"user"]);
        Permission::create(["name"=>"Read-Patents","guard_name"=>"user"]);

        Permission::create(["name"=>"Create-Appoinment","guard_name"=>"user"]);
        Permission::create(["name"=>"Update-Appoinment","guard_name"=>"user"]);
        Permission::create(["name"=>"Delete-Appoinment","guard_name"=>"user"]);
        Permission::create(["name"=>"Read-Appoinments","guard_name"=>"user"]);

        Permission::create(["name"=>"Create-Specialite","guard_name"=>"user"]);
        Permission::create(["name"=>"Update-Specialite","guard_name"=>"user"]);
        Permission::create(["name"=>"Delete-Specialite","guard_name"=>"user"]);
        Permission::create(["name"=>"Read-Specialites","guard_name"=>"user"]);

        Permission::create(["name"=>"Create-Role","guard_name"=>"user"]);
        Permission::create(["name"=>"Read-Roles","guard_name"=>"user"]);
        Permission::create(["name"=>"Delete-Role","guard_name"=>"user"]);
        Permission::create(["name"=>"Update-Role","guard_name"=>"user"]);


    }
}

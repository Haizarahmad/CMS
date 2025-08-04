<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'manage students']);
        Permission::create(['name' => 'manage classrooms']);
        Permission::create(['name' => 'manage subjects']);

        $teacher = Role::findByName('teacher');
        $superadmin = Role::findByName('superadmin');

        $teacher->givePermissionTo('manage students');
        $superadmin->givePermissionTo('manage classrooms');
        $superadmin->givePermissionTo('manage subjects');
    }
}

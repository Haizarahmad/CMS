<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperadminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::findByName('superadmin');
        $superadmin->givePermissionTo('manage classrooms');
        $superadmin->givePermissionTo('manage subjects');
    }
}

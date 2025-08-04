<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'superadmin']);
        Role::firstOrCreate(['name' => 'teacher']);

        $user = User::find(3); // for example, user with ID 1
        $user->assignRole('superadmin');

        $teachers = User::where('role', 1)->get();
        foreach ($teachers as $teacher) {
            $teacher->assignRole('teacher');
        }
    }
}

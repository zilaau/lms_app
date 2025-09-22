<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure table exists in case seeder is run before migration accidentally
        if (!Schema::hasTable('roles')) {
            return;
        }

        $roles = [
            ['name' => 'admin', 'description' => 'Administrator with full access', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'instructor', 'description' => 'Instructor who creates courses', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'student', 'description' => 'Student who enrolls and learns', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Upsert by name
        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role['name']], $role);
        }
    }
}

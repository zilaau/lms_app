<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasTable('roles')) {
            return;
        }

        $now = now();

        // Ensure roles exist and get IDs
        $roles = DB::table('roles')->pluck('id', 'name');
        if ($roles->isEmpty()) {
            return; // roles seeder should run first
        }

        // Admin user
        $adminId = DB::table('users')->updateOrInsert(
            ['email' => 'admin@lms.local'],
            [
                'name' => 'Site Administrator',
                'password' => Hash::make('Admin@12345'),
                'role_id' => $roles['admin'] ?? null,
                'phone' => '000-111-2222',
                'remember_token' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        // Instructors
        $instructors = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@lms.local',
                'phone' => '555-100-2000',
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@lms.local',
                'phone' => '555-100-3000',
            ],
        ];

        foreach ($instructors as $ins) {
            DB::table('users')->updateOrInsert(
                ['email' => $ins['email']],
                [
                    'name' => $ins['name'],
                    'password' => Hash::make('Password@123'),
                    'role_id' => $roles['instructor'] ?? null,
                    'phone' => $ins['phone'],
                    'remember_token' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        // Students
        $students = [
            ['name' => 'Charlie Kim', 'email' => 'charlie@lms.local', 'phone' => '555-200-1000'],
            ['name' => 'Dana Lee', 'email' => 'dana@lms.local', 'phone' => '555-200-1100'],
            ['name' => 'Evan Turner', 'email' => 'evan@lms.local', 'phone' => '555-200-1200'],
            ['name' => 'Fiona Park', 'email' => 'fiona@lms.local', 'phone' => '555-200-1300'],
        ];

        foreach ($students as $stu) {
            DB::table('users')->updateOrInsert(
                ['email' => $stu['email']],
                [
                    'name' => $stu['name'],
                    'password' => Hash::make('Password@123'),
                    'role_id' => $roles['student'] ?? null,
                    'phone' => $stu['phone'],
                    'remember_token' => '',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}

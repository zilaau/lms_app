<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CoursesTableSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('courses') || !Schema::hasTable('users')) {
            return;
        }

        $now = now();

        // Get instructors
        $instructors = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'instructor')
            ->select('users.id', 'users.name')
            ->get();

        if ($instructors->isEmpty()) {
            return; // need instructors first
        }

        $courses = [
            [
                'title' => 'PHP for Beginners',
                'description' => 'Learn the fundamentals of PHP and build dynamic web applications. Includes variables, arrays, functions, OOP and Laravel basics.',
                'thumbnail' => 'courses/php-beginners.jpg',
                'instructor' => 'Alice Johnson',
            ],
            [
                'title' => 'Modern JavaScript & Node.js',
                'description' => 'Deep dive into ES6+, asynchronous JS, Node.js ecosystem, Express, and REST APIs with best practices.',
                'thumbnail' => 'courses/js-node.jpg',
                'instructor' => 'Bob Smith',
            ],
            [
                'title' => 'Laravel From Scratch',
                'description' => 'Build a complete Laravel application: routing, Eloquent, authentication, queues, and deployment.',
                'thumbnail' => 'courses/laravel-scratch.jpg',
                'instructor' => 'Alice Johnson',
            ],
        ];

        foreach ($courses as $course) {
            $insId = optional($instructors->firstWhere('name', $course['instructor']))->id;
            if (!$insId) { continue; }
            DB::table('courses')->updateOrInsert(
                ['title' => $course['title']],
                [
                    'description' => $course['description'],
                    'instructor_id' => $insId,
                    'thumbnail' => $course['thumbnail'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}

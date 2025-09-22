<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseEnrollmentsSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('course_enrollments')) {
            return;
        }

        $now = now();

        $students = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'student')
            ->select('users.id', 'users.name')
            ->get();
        $courses = DB::table('courses')->select('id', 'title')->get();

        if ($students->isEmpty() || $courses->isEmpty()) {
            return;
        }

        // Enroll each student into 2 courses (round-robin)
        foreach ($students as $i => $stu) {
            $selectedCourses = $courses->slice($i % $courses->count(), 2);
            if ($selectedCourses->count() < 2) {
                $selectedCourses = $selectedCourses->merge($courses->take(2 - $selectedCourses->count()));
            }
            foreach ($selectedCourses as $course) {
                DB::table('course_enrollments')->updateOrInsert(
                    ['course_id' => $course->id, 'student_id' => $stu->id],
                    [
                        'enrolled_at' => $now->copy()->subDays(rand(10, 30)),
                        'progress_percentage' => rand(10, 80),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AssignmentsSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('assignments') || !Schema::hasTable('courses')) {
            return;
        }

        $now = now();
        $courses = DB::table('courses')->select('id', 'title')->get();
        foreach ($courses as $course) {
            $assignments = [
                [
                    'title' => 'Setup & Hello World',
                    'description' => 'Install tools and create a simple Hello World program relevant to the course language/framework.',
                    'due_date' => $now->copy()->addDays(7),
                    'max_points' => 100,
                    'instructions' => 'Submit a zip or repository link with a README.',
                ],
                [
                    'title' => 'Mini Project',
                    'description' => 'Build a small project applying the concepts learned (e.g., CLI app, REST API, or simple web page).',
                    'due_date' => $now->copy()->addDays(14),
                    'max_points' => 100,
                    'instructions' => 'Include documentation and tests where applicable.',
                ],
            ];

            foreach ($assignments as $idx => $a) {
                DB::table('assignments')->updateOrInsert(
                    ['course_id' => $course->id, 'title' => $a['title']],
                    array_merge($a, [
                        'course_id' => $course->id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])
                );
            }
        }
    }
}

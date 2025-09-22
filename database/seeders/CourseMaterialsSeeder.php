<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseMaterialsSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('course_materials') || !Schema::hasTable('courses')) {
            return;
        }

        $now = now();
        $courses = DB::table('courses')->select('id', 'title')->get();
        foreach ($courses as $course) {
            $materials = [
                [
                    'title' => $course->title . ' - Introduction',
                    'description' => 'Overview of the course and setup instructions.',
                    'file_path' => 'materials/' . $course->id . '/01-intro.mp4',
                    'file_type' => 'video',
                    'order_index' => 1,
                ],
                [
                    'title' => $course->title . ' - Basics',
                    'description' => 'Core fundamentals explained with examples.',
                    'file_path' => 'materials/' . $course->id . '/02-basics.pdf',
                    'file_type' => 'pdf',
                    'order_index' => 2,
                ],
                [
                    'title' => $course->title . ' - Project Setup',
                    'description' => 'Setting up the development environment and scaffolding the project.',
                    'file_path' => 'materials/' . $course->id . '/03-setup.mp4',
                    'file_type' => 'video',
                    'order_index' => 3,
                ],
                [
                    'title' => $course->title . ' - Best Practices',
                    'description' => 'Clean code, testing, and deployment tips.',
                    'file_path' => 'materials/' . $course->id . '/04-best-practices.docx',
                    'file_type' => 'document',
                    'order_index' => 4,
                ],
            ];

            foreach ($materials as $m) {
                DB::table('course_materials')->updateOrInsert(
                    ['course_id' => $course->id, 'order_index' => $m['order_index']],
                    array_merge($m, [
                        'course_id' => $course->id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])
                );
            }
        }
    }
}

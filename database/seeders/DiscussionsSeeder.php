<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiscussionsSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('discussions')) {
            return;
        }

        $now = now();
        $courses = DB::table('courses')->select('id', 'title', 'instructor_id')->get();

        foreach ($courses as $course) {
            $topics = [
                [
                    'title' => 'Course Q&A',
                    'description' => 'Ask any question related to ' . $course->title . '.',
                    'created_by' => $course->instructor_id,
                ],
                [
                    'title' => 'Share your progress',
                    'description' => 'What did you build this week? Share screenshots or links.',
                    'created_by' => $course->instructor_id,
                ],
            ];

            foreach ($topics as $t) {
                DB::table('discussions')->updateOrInsert(
                    ['course_id' => $course->id, 'title' => $t['title']],
                    [
                        'description' => $t['description'],
                        'created_by' => $t['created_by'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}

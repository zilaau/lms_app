<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProgressTrackingSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('progress_tracking')) {
            return;
        }

        $now = now();

        $enrollments = DB::table('course_enrollments')->select('course_id', 'student_id')->get();
        $materialsByCourse = DB::table('course_materials')
            ->select('id', 'course_id')
            ->orderBy('order_index')
            ->get()
            ->groupBy('course_id');

        foreach ($enrollments as $enrollment) {
            $materials = $materialsByCourse->get($enrollment->course_id, collect());
            // Mark first N materials as completed based on progress percentage
            $progress = DB::table('course_enrollments')->where([
                'course_id' => $enrollment->course_id,
                'student_id' => $enrollment->student_id,
            ])->value('progress_percentage') ?? 0;

            $countToComplete = (int) round(($progress / 100) * max(1, $materials->count()));
            foreach ($materials->take($countToComplete) as $m) {
                DB::table('progress_tracking')->updateOrInsert(
                    [
                        'user_id' => $enrollment->student_id,
                        'course_id' => $enrollment->course_id,
                        'material_id' => $m->id,
                    ],
                    [
                        'completed_at' => $now->copy()->subDays(rand(0, 7)),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}

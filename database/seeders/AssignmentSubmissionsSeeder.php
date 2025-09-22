<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AssignmentSubmissionsSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('assignment_submissions')) {
            return;
        }

        $now = now();

        $studentIds = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'student')
            ->pluck('users.id');

        $instructorIds = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'instructor')
            ->pluck('users.id');

        $assignments = DB::table('assignments')->select('id', 'course_id', 'title')->get();

        if ($studentIds->isEmpty() || $assignments->isEmpty()) {
            return;
        }

        foreach ($assignments as $assignment) {
            foreach ($studentIds as $sid) {
                $submittedAt = $now->copy()->subDays(rand(1, 9));
                $graded = (bool) rand(0, 1);
                $grade = $graded ? rand(70, 100) : null;
                $gradedAt = $graded ? $submittedAt->copy()->addDays(rand(0, 3)) : null;
                $gradedBy = $graded ? ($instructorIds->random() ?? null) : null;

                DB::table('assignment_submissions')->updateOrInsert(
                    [
                        'assignment_id' => $assignment->id,
                        'student_id' => $sid,
                    ],
                    [
                        'file_path' => 'submissions/' . $assignment->id . '/' . $sid . '-submission.zip',
                        'submitted_at' => $submittedAt,
                        'grade' => $grade,
                        'feedback' => $graded ? 'Good work. See comments in the repository.' : null,
                        'graded_at' => $gradedAt,
                        'graded_by' => $gradedBy,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}

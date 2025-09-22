<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CertificatesSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('certificates')) {
            return;
        }

        $now = now();

        // Issue certificates to students who have >= 80% progress in a course
        $eligible = DB::table('course_enrollments')
            ->where('progress_percentage', '>=', 80)
            ->get(['course_id', 'student_id']);

        foreach ($eligible as $row) {
            $exists = DB::table('certificates')->where([
                'course_id' => $row->course_id,
                'user_id' => $row->student_id,
            ])->exists();
            if ($exists) continue;

            DB::table('certificates')->insert([
                'user_id' => $row->student_id,
                'course_id' => $row->course_id,
                'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
                'issued_at' => $now->copy()->subDays(rand(0, 3)),
                'certificate_path' => 'certificates/' . $row->course_id . '/' . $row->student_id . '-certificate.pdf',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}

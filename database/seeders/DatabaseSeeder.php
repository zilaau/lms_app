<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CoursesTableSeeder;
use Database\Seeders\CourseMaterialsSeeder;
use Database\Seeders\AssignmentsSeeder;
use Database\Seeders\CourseEnrollmentsSeeder;
use Database\Seeders\AssignmentSubmissionsSeeder;
use Database\Seeders\DiscussionsSeeder;
use Database\Seeders\DiscussionRepliesSeeder;
use Database\Seeders\ProgressTrackingSeeder;
use Database\Seeders\CertificatesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed base lookup data and development samples (programming LMS)
        $this->call([
            // Base
            RolesTableSeeder::class,
            UsersTableSeeder::class,

            // Courses and content
            CoursesTableSeeder::class,
            CourseMaterialsSeeder::class,
            AssignmentsSeeder::class,

            // Enrollments and activity
            CourseEnrollmentsSeeder::class,
            AssignmentSubmissionsSeeder::class,
            DiscussionsSeeder::class,
            DiscussionRepliesSeeder::class,
            ProgressTrackingSeeder::class,

            // Certificates for completed progress
            CertificatesSeeder::class,
        ]);
    }
}

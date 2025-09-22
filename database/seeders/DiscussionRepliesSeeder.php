<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiscussionRepliesSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('discussion_replies') || !Schema::hasTable('discussions')) {
            return;
        }

        $now = now();

        $discussions = DB::table('discussions')->select('id', 'course_id', 'title', 'created_by')->get();
        $students = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'student')
            ->select('users.id', 'users.name')
            ->get();

        foreach ($discussions as $discussion) {
            // Instructor opens, students reply
            $firstReplyUser = optional($students->random())->id;
            $secondReplyUser = optional($students->random())->id;
            if ($firstReplyUser) {
                $parentId = DB::table('discussion_replies')->insertGetId([
                    'discussion_id' => $discussion->id,
                    'user_id' => $firstReplyUser,
                    'content' => 'Thanks for starting this thread! I have a question about the setup instructions.',
                    'parent_id' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Nested reply from instructor
                DB::table('discussion_replies')->insert([
                    'discussion_id' => $discussion->id,
                    'user_id' => $discussion->created_by,
                    'content' => 'Great question. Make sure you installed the correct PHP version and enabled required extensions.',
                    'parent_id' => $parentId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            if ($secondReplyUser) {
                DB::table('discussion_replies')->insert([
                    'discussion_id' => $discussion->id,
                    'user_id' => $secondReplyUser,
                    'content' => 'Sharing my progress: I built the API endpoints and added basic tests.',
                    'parent_id' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}

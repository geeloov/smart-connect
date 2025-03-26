<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CVJobCompatibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get current user ID if authenticated
        $currentUserId = Auth::check() ? Auth::id() : null;
        
        // User IDs to create records for
        $userIds = [7]; // Always create for user ID 7
        
        // Add current user ID if it's different from 7
        if ($currentUserId && $currentUserId != 7) {
            $userIds[] = $currentUserId;
        }
        
        $this->command->info('Will create records for user IDs: ' . implode(', ', $userIds));
        
        // Process each user ID
        foreach ($userIds as $userId) {
            // Clear existing records for this user
            $deletedCount = DB::table('cv_job_compatibility')->where('user_id', $userId)->delete();
            $this->command->info("Deleted {$deletedCount} existing compatibility records for user ID {$userId}");
            
            // Get existing job positions and CVs to ensure we only use valid IDs
            $jobPositions = DB::table('job_positions')->pluck('id')->toArray();
            $cvs = DB::table('cvs')->where('user_id', $userId)->pluck('id')->toArray();
            
            if (empty($jobPositions)) {
                $this->command->info("No job positions found in database for user ID {$userId}. Skipping seeder.");
                continue;
            }
            
            if (empty($cvs)) {
                $this->command->info("No CVs found for user ID {$userId}. Skipping seeder.");
                continue;
            }
            
            // Use the first CV we find for this user
            $cvId = $cvs[0];
            
            // Create records only for existing job positions
            $data = [];
            $scores = [85, 68, 42, 93];
            $explanations = [
                'Strong match for required skills. Experience in Laravel is a plus.',
                'Good match but lacking some key experience in team leadership.',
                'Skills match is below average. Missing required experience in cloud technologies.',
                'Excellent match. Skills and experience align perfectly with job requirements.'
            ];
            
            // Get up to 4 job positions
            $positionsToUse = array_slice($jobPositions, 0, 4);
            
            foreach ($positionsToUse as $index => $jobPositionId) {
                $data[] = [
                    'user_id' => $userId,
                    'cv_id' => $cvId,
                    'job_position_id' => $jobPositionId,
                    'compatibility_score' => $scores[$index % count($scores)],
                    'explanation' => $explanations[$index % count($explanations)],
                    'created_at' => Carbon::now()->subDays(10 - ($index * 2)),
                    'updated_at' => Carbon::now()->subDays(10 - ($index * 2)),
                ];
            }
            
            if (!empty($data)) {
                // Insert the records
                DB::table('cv_job_compatibility')->insert($data);
                $this->command->info('Added ' . count($data) . " compatibility records for user ID {$userId}.");
            } else {
                $this->command->info("No data created for user ID {$userId}. Check your job positions and CVs.");
            }
        }
    }
} 
<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\JobMatch;
use App\Models\JobPosting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'recruiter',
        ]);

        // Create recruiter users
        $recruiters = User::factory(5)->recruiter()->create();

        // Create job seeker users
        $jobSeekers = User::factory(20)->jobSeeker()->create();

        // Create candidates for job seekers
        $candidates = [];
        foreach ($jobSeekers as $jobSeeker) {
            $candidates[] = Candidate::factory()->create([
                'user_id' => $jobSeeker->id,
            ]);
        }

        // Create job postings from recruiters
        $jobPostings = [];
        foreach ($recruiters as $recruiter) {
            $numPostings = rand(1, 3);
            for ($i = 0; $i < $numPostings; $i++) {
                $jobPostings[] = JobPosting::factory()->create([
                    'user_id' => $recruiter->id,
                    'status' => 'active',
                ]);
            }
        }

        // Create job matches
        foreach ($jobPostings as $jobPosting) {
            // Match with 30-70% of candidates
            $numMatches = rand(intval(count($candidates) * 0.3), intval(count($candidates) * 0.7));
            $matchedCandidates = array_rand(array_flip(array_column($candidates, 'id')), $numMatches);
            
            if (!is_array($matchedCandidates)) {
                $matchedCandidates = [$matchedCandidates];
            }

            foreach ($matchedCandidates as $candidateId) {
                $matchScore = rand(40, 95);
                
                // Determine status based on score
                $status = 'pending';
                if ($matchScore >= 80) {
                    $status = rand(0, 1) ? 'viewed' : 'pending';
                } else if ($matchScore >= 60) {
                    $status = rand(0, 2) ? 'pending' : 'viewed';
                }

                JobMatch::create([
                    'candidate_id' => $candidateId,
                    'job_posting_id' => $jobPosting->id,
                    'match_score' => $matchScore,
                    'status' => $status,
                    'viewed_by_candidate' => $status === 'viewed',
                    'viewed_by_recruiter' => rand(0, 1),
                    'match_details' => [
                        'skills_matched' => rand(50, 100),
                        'experience_matched' => rand(40, 100),
                        'location_matched' => rand(0, 100),
                    ],
                ]);
            }
        }
    }
}

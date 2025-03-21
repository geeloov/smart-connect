<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->jobSeeker(),
            'phone' => fake()->phoneNumber(),
            'location' => fake()->city() . ', ' . fake()->country(),
            'skills' => fake()->randomElements([
                'JavaScript', 'Python', 'Java', 'PHP', 'C#', 'C++', 'TypeScript',
                'React', 'Angular', 'Vue.js', 'Laravel', 'Django', 'Express',
                'Node.js', 'SQL', 'MongoDB', 'AWS', 'Docker', 'Git',
                'HTML', 'CSS', 'Tailwind', 'Bootstrap', 'UI/UX Design'
            ], fake()->numberBetween(3, 8)),
            'experience_years' => fake()->numberBetween(0, 15),
            'education' => [
                [
                    'degree' => fake()->randomElement(['Bachelor', 'Master', 'PhD', 'Associate']),
                    'field' => fake()->randomElement(['Computer Science', 'Information Technology', 'Software Engineering', 'Data Science', 'Business']),
                    'institution' => fake()->company() . ' University',
                    'year' => fake()->numberBetween(2010, 2023)
                ]
            ],
            'career_interests' => fake()->paragraph(),
            'languages' => [
                [
                    'language' => 'English',
                    'proficiency' => fake()->randomElement(['Native', 'Fluent', 'Intermediate', 'Basic'])
                ],
                [
                    'language' => fake()->randomElement(['Spanish', 'French', 'German', 'Mandarin', 'Japanese']),
                    'proficiency' => fake()->randomElement(['Native', 'Fluent', 'Intermediate', 'Basic'])
                ]
            ],
            'bio' => fake()->paragraphs(2, true),
            'last_cv_upload' => fake()->optional(0.7)->dateTimeThisYear(),
        ];
    }
} 
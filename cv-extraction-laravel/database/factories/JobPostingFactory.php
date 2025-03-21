<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosting>
 */
class JobPostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $techSkills = [
            'JavaScript', 'Python', 'Java', 'PHP', 'C#', 'C++', 'TypeScript',
            'React', 'Angular', 'Vue.js', 'Laravel', 'Django', 'Express',
            'Node.js', 'SQL', 'MongoDB', 'AWS', 'Docker', 'Git',
            'HTML', 'CSS', 'Tailwind', 'Bootstrap', 'UI/UX Design'
        ];

        $isRemote = fake()->boolean(40);
        $location = $isRemote ? null : fake()->city() . ', ' . fake()->country();
        $salaryMin = fake()->numberBetween(30000, 80000);
        $salaryMax = fake()->numberBetween($salaryMin + 10000, $salaryMin + 50000);

        return [
            'user_id' => User::factory()->recruiter(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'required_skills' => fake()->randomElements($techSkills, fake()->numberBetween(3, 7)),
            'experience_level' => fake()->randomElement(['entry', 'mid', 'senior']),
            'location' => $location,
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMax,
            'is_remote' => $isRemote,
            'status' => fake()->randomElement(['active', 'closed', 'draft']),
            'expires_at' => fake()->dateTimeBetween('+1 week', '+3 months'),
        ];
    }

    /**
     * Indicate that the job posting is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'expires_at' => fake()->dateTimeBetween('+1 week', '+3 months'),
        ]);
    }

    /**
     * Indicate that the job posting is remote.
     */
    public function remote(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_remote' => true,
            'location' => null,
        ]);
    }
} 
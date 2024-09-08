<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Newjob;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resume' => $this->faker->url,
            'cover_letter' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Applied', 'Reviewed', 'Accepted', 'Rejected']),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'job_id' => Newjob::where('stutas', 'Approve')->inRandomOrder()->first()->job_id,
            'user_id' => User::where('role', 'Candidate')->inRandomOrder()->first()->user_id,
        ];
    }
}

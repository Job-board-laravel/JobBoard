<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Newjob;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Newjob>
 */
class NewjobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'requirement' => $this->faker->paragraph,
            'benefit' => $this->faker->paragraph,
            'location' => $this->faker->city,
            'contact_info' => $this->faker->email,
            'logo' => $this->faker->imageUrl(640, 480, 'technics'),
            'technologies' => implode(',', $this->faker->words(3)),
            'work_type' => $this->faker->randomElement(['remote', 'onsite', 'hybrid']),
            'salary_range' => $this->faker->randomFloat(2, 30000, 100000),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
          'user_id' => $this->faker->numberBetween(1, 10), // Random user_id between 1 and 10
            'category_id' => $this->faker->numberBetween(1, 10), // Random category_id between 1 and 10
            'stutas' => $this->faker->randomElement(['Approve', 'Reject', 'Pending']),
        ];
    }
}

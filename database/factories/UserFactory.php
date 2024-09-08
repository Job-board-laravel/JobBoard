<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'name' => $this->faker->name,
                'phone' => $this->faker->phoneNumber,
                'email' => $this->faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Default password
                'image' => 'images/default.png',
                'role' => $this->faker->randomElement(['Employer', 'Candidate', 'Admin']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ];
    
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

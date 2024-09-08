<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'role' => 'Admin',
        ]);

        // Create 5 Employers
        User::factory( 5)->create([
            'role' => 'Employer',
        ]);

        // Create 5 Candidates
        User::factory( 5)->create([
            'role' => 'Candidate',
        ]);
    
    }
}

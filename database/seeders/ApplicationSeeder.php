<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Newjob;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $acceptedJobs = Newjob::where('stutas', 'Approve')->get();

        foreach ($acceptedJobs as $job) {
            Application::factory()->count(5)->create(['job_id' => $job->job_id]);}
    }
}

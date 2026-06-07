<?php

namespace Database\Seeders;

use App\Models\CategoryKAL;
use App\Models\TaskKAL;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@flow.ac.za'],
            ['name' => 'TaskFlow Admin', 'password' => Hash::make('P@ssword'), 'role' => 'admin']
        );

        $member = User::updateOrCreate(
            ['email' => 'developer@flow.ac.za'],
            ['name' => 'TaskFlow Developer', 'password' => Hash::make('P@ssword'), 'role' => 'team_member']
        );

        User::updateOrCreate(
            ['email' => 'guest@flow.ac.za'],
            ['name' => 'TaskFlow Guest', 'password' => Hash::make('P@ssword'), 'role' => 'guest']
        );

        $categories = collect([
            ['name' => 'Web Development',     'color' => '#1E3A5F'],
            ['name' => 'Mobile Apps',          'color' => '#FF6B6B'],
            ['name' => 'Cybersecurity',        'color' => '#2f5f8f'],
            ['name' => 'AI / Machine Learning','color' => '#6a0dad'],
            ['name' => 'Databases',            'color' => '#8a98a8'],
            ['name' => 'UI/UX Design',         'color' => '#FF9F43'],
            ['name' => 'Networking',           'color' => '#D3D3D3'],
        ])->map(fn ($data) => CategoryKAL::updateOrCreate(['name' => $data['name']], $data));

        TaskKAL::updateOrCreate(
            ['title' => 'Build REST API for client portal'],
            [
                'category_id' => $categories[0]->id,
                'assigned_to' => $member->id,
                'created_by' => $admin->id,
                'description' => 'Design and implement RESTful endpoints for the client-facing portal using Laravel.',
                'priority' => 'high',
                'status' => 'in_progress',
                'deadline' => now()->addDays(2)->toDateString(),
            ]
        );

        TaskKAL::updateOrCreate(
            ['title' => 'Fix login crash on Android app'],
            [
                'category_id' => $categories[1]->id,
                'assigned_to' => $member->id,
                'created_by' => $admin->id,
                'description' => 'Investigate and resolve the null pointer exception causing crashes on Android 13 devices.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => now()->addDays(3)->toDateString(),
            ]
        );

        TaskKAL::updateOrCreate(
            ['title' => 'Run penetration test on staging server'],
            [
                'category_id' => $categories[2]->id,
                'assigned_to' => $admin->id,
                'created_by' => $admin->id,
                'description' => 'Perform a full penetration test and document vulnerabilities found on the staging environment.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => now()->addDay()->toDateString(),
            ]
        );

        TaskKAL::updateOrCreate(
            ['title' => 'Train ML model for customer churn prediction'],
            [
                'category_id' => $categories[3]->id,
                'assigned_to' => $member->id,
                'created_by' => $admin->id,
                'description' => 'Prepare dataset, train a classification model, and evaluate accuracy for churn prediction.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => now()->addWeek()->toDateString(),
            ]
        );
    }
}

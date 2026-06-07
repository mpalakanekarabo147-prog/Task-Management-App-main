<?php

namespace Database\Factories;

use App\Models\CategoryKAL;
use App\Models\TaskKAL;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskKALFactory extends Factory
{
    protected $model = TaskKAL::class;

    public function definition()
    {
        return [
            'category_id' => CategoryKAL::factory(),
            'assigned_to' => User::factory()->teamMember(),
            'created_by' => User::factory()->admin(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'tags' => [fake()->word(), fake()->word()],
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'deadline' => now()->addDays(fake()->numberBetween(1, 14))->toDateString(),
        ];
    }
}

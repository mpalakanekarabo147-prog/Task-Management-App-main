<?php

namespace Database\Factories;

use App\Models\CategoryKAL;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryKALFactory extends Factory
{
    protected $model = CategoryKAL::class;

    public function definition()
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'color' => fake()->hexColor(),
        ];
    }
}

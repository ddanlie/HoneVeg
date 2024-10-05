<?php

namespace Database\Factories;

use App\Models\ChangeCategoriesDesign;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DesignLabels>
 */
class DesignLabelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'design_id' => ChangeCategoriesDesign::factory(),
            'name' => fake()->word(),
            'type' => fake()->randomElement(['int', 'text', 'float', 'date'])
        ];
    }
}

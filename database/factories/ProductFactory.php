<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Label;
use App\Models\ProductLabelValue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_user_id' => User::factory()->seller(),
            'category_id' => Category::factory(),
            'price' => fake()->randomFloat(null, 10, 200),
            'description' => fake()->sentence(),
            'available_amount' => fake()->randomNumber(),
            'total_rating' => fake()->randomFloat(null, 0, 5),
            'name' => fake()->word()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {      
            $matchingLabels = Label::where('category_id', $product->category_id)->get();      
            foreach ($matchingLabels as $label) {
                ProductLabelValue::factory()->create([
                    'product_id' => $product->product_id,
                    'label_id' => $label->label_id,
                ]);
            }

        });
    }
}

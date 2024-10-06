<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Models\Products;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name'=>'category',
            'parent_category_id'=> 0
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            if ($category->parent_category_id === 0) {
                $category->parent_category_id = $category->category_id;
                
            }
            $category->name = 'category'.$category->category_id;
            $category->save();
            
            Label::factory()->create([
                'category_id' => $category->category_id
            ]);

        });
    }

    public function withChildren($depth=1) {
        return $this->afterCreating(function (Category $category) use ($depth) {
            $parent_id = $category->category_id;

            for($i = 0; $i < $depth; $i++) {
                $child = Category::factory()->create([
                    'parent_category_id' => $parent_id
                ]);

                $parent_id = $child->category_id;
            }
            
        });
    }
}

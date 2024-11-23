<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseCategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //USAGE:
        //php artisan db:seed BaseCategorySeeder
        //php artisan migrate:fresh --seed -> refresh db and seed data

        $mainCat = \App\Models\Category::factory()->create([
            'name' => 'base category'
        ]);

        $vegetablesCat = \App\Models\Category::factory()->withLabel("Production Method", "text")->create([
            'name' => 'Vegetables'
        ]);

        $fruitsCat = \App\Models\Category::factory()->withLabel("Production Method", "text")->create([
            'name' => 'Fruits'
        ]);

        $mushroomsCat = \App\Models\Category::factory()->withLabel("Wild/cultivated", "text")->create([
            'name' => 'Mushrooms'
        ]);

        $herbsCat = \App\Models\Category::factory()->withLabel("Dry/fresh", "text")->create([
            'name' => 'Herbs'
        ]);


        // $leafyVegetablesCat = \App\Models\Category::factory()->withLabel("Freshness Duration in days", "number")->create([
        //     'name' => 'Leafy vegetables',
        //     'parent_category_id' => $vegetablesCat->category_id
        // ]);

        // $rootVegetablesCat = \App\Models\Category::factory()->withLabel("Sort", "text")->create([
        //     'name' => 'Root vegetables',
        //     'parent_category_id' => $vegetablesCat->category_id
        // ]);

        // $fruitingVegetablesCat = \App\Models\Category::factory()->withLabel("Sort", "text")->create([
        //     'name' => 'Fruiting vegetables',
        //     'parent_category_id' => $vegetablesCat->category_id
        // ]);


        // $treeFruitsCat = \App\Models\Category::factory()->withLabel("Sort", "text")->create([
        //     'name' => 'Tree Fruits',
        //     'parent_category_id' => $fruitsCat->category_id
        // ]);

        // $citrusesCat = \App\Models\Category::factory()->withLabel("Seeds presence", "text")->create([
        //     'name' => 'Citruses',
        //     'parent_category_id' => $fruitsCat->category_id
        // ]);

        // $berriesCat = \App\Models\Category::factory()->withLabel("Sweet/sour", "text")->withLabel("Sort", 'text')->create([
        //     'name' => 'Berries',
        //     'parent_category_id' => $fruitsCat->category_id
        // ]);

        // $melonsCat = \App\Models\Category::factory()->withLabel("Size", "text")->create([
        //     'name' => 'Melons',
        //     'parent_category_id' => $fruitsCat->category_id
        // ]);

        // $LettuceCat = \App\Models\Category::factory()->withLabel("Sort", "text")->create([
        //     'name' => 'Lettuce',
        //     'parent_category_id' => $leafyVegetablesCat->category_id
        // ]);

        // $SpinachCat = \App\Models\Category::factory()->withLabel("Type", "text")->create([
        //     'name' => 'Spinach',
        //     'parent_category_id' => $leafyVegetablesCat->category_id
        // ]);

        // $CabbageCat = \App\Models\Category::factory()->withLabel("Sort", "text")->create([
        //     'name' => 'Cabbage',
        //     'parent_category_id' => $leafyVegetablesCat->category_id
        // ]);

        // $potatoCat = \App\Models\Category::factory()->withLabel("Type", "text")->create([
        //     'name' => 'Potato',
        //     'parent_category_id' => $rootVegetablesCat->category_id
        // ]);

        // $carrotCat = \App\Models\Category::factory()->withLabel("Length", "number")->create([
        //     'name' => 'Carrot',
        //     'parent_category_id' => $rootVegetablesCat->category_id
        // ]);

        // $onionCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Onion',
        //     'parent_category_id' => $rootVegetablesCat->category_id
        // ]);

        // $garlicCat = \App\Models\Category::factory()->withLabel("Fresh/dried/pickled", "text")->create([
        //     'name' => 'Garlic',
        //     'parent_category_id' => $rootVegetablesCat->category_id
        // ]);

        // $tomatoCat = \App\Models\Category::factory()->withLabel("Juicy/fleshy", "text")->create([
        //     'name' => 'Tomatoes',
        //     'parent_category_id' => $fruitingVegetablesCat->category_id
        // ]);

        // $cucumberCat = \App\Models\Category::factory()->withLabel("Length", "number")->create([
        //     'name' => 'Cucumbers',
        //     'parent_category_id' => $fruitingVegetablesCat->category_id
        // ]);

        // $bellpeppersCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Bell peppers',
        //     'parent_category_id' => $fruitingVegetablesCat->category_id
        // ]);

        // $eggplantCat = \App\Models\Category::factory()->withLabel("color", "text")->create([
        //     'name' => 'EggPlants',
        //     'parent_category_id' => $fruitingVegetablesCat->category_id
        // ]);

        // $appleCat = \App\Models\Category::factory()->withLabel("Sweet/sour", "text")->create([
        //     'name' => 'Apples',
        //     'parent_category_id' => $treeFruitsCat->category_id
        // ]);

        // $bananasCat = \App\Models\Category::factory()->withLabel("Length", "number")->create([
        //     'name' => 'Bananas',
        //     'parent_category_id' => $treeFruitsCat->category_id
        // ]);

        // $peachesCat = \App\Models\Category::factory()->withLabel("Ripeness", "text")->create([
        //     'name' => 'Peaches',
        //     'parent_category_id' => $treeFruitsCat->category_id
        // ]);

        // $orangesCat = \App\Models\Category::factory()->withLabel("Sweet/sour", "text")->create([
        //     'name' => 'Apples',
        //     'parent_category_id' => $citrusesCat->category_id
        // ]);

        // $lemonsCat = \App\Models\Category::factory()->withLabel("Weight", "number")->create([
        //     'name' => 'Lemons',
        //     'parent_category_id' => $citrusesCat->category_id
        // ]);

        // $limesCat = \App\Models\Category::factory()->withLabel("Weight", "number")->create([
        //     'name' => 'Limes',
        //     'parent_category_id' => $citrusesCat->category_id
        // ]);

        // $tangerinesCat = \App\Models\Category::factory()->withLabel("Sweet/sour", "text")->create([
        //     'name' => 'Tangerines',
        //     'parent_category_id' => $citrusesCat->category_id
        // ]);

        // $strawberriesCat = \App\Models\Category::factory()->withLabel("Juicy/firm", "text")->create([
        //     'name' => 'Strawberries',
        //     'parent_category_id' => $berriesCat->category_id
        // ]);

        // $blueberriesCat = \App\Models\Category::factory()->withLabel("Juicy/firm", "text")->create([
        //     'name' => 'Blueberries',
        //     'parent_category_id' => $berriesCat->category_id
        // ]);

        // $raspberriesCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Raspberries',
        //     'parent_category_id' => $berriesCat->category_id
        // ]);

        // $currantCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Currant',
        //     'parent_category_id' => $berriesCat->category_id
        // ]);

        // $melonCat = \App\Models\Category::factory()->withLabel("Sweetness", "text")->create([
        //     'name' => 'Melons',
        //     'parent_category_id' => $melonsCat->category_id
        // ]);

        // $watermCat = \App\Models\Category::factory()->withLabel("Seeds presence", "text")->create([
        //     'name' => 'Watermelons',
        //     'parent_category_id' => $melonsCat->category_id
        // ]);

        // $pumpkinCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Pumpkins',
        //     'parent_category_id' => $melonsCat->category_id
        // ]);

        // $morelsCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Morels',
        //     'parent_category_id' => $mushroomsCat->category_id
        // ]);

        // $champCat = \App\Models\Category::factory()->withLabel("Color", "text")->withLabel("Fresh/pickled", "text")->create([
        //     'name' => 'Champignons',
        //     'parent_category_id' => $mushroomsCat->category_id
        // ]);

        // $trufflesCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Truffles',
        //     'parent_category_id' => $mushroomsCat->category_id
        // ]);

        // $morelsCat = \App\Models\Category::factory()->withLabel("Color", "text")->create([
        //     'name' => 'Morels',
        //     'parent_category_id' => $mushroomsCat->category_id
        // ]);



    }
}

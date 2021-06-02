<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $name,
            'description' => $this->faker->words(100, true),
            'slug' => Str::slug($name),
            'price' => $this->faker->numberBetween(50, 500),
            'image' => $this->faker->imageUrl(),
        ];
    }
}

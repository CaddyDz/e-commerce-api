<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::select('uuid')->get()->each(
            fn ($category) =>
            $category->products()->create(Product::factory()->make([
                'metadata' => json_encode([
                    'brand' => Brand::inRandomOrder()->value('uuid'),
                    'image' => 'tmp',
                ]),
            ])->toArray())
        );
    }
}

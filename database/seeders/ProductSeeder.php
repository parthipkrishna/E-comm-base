<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categories = [1, 2, 3, 4, 5]; // Your existing category IDs

        for ($i = 0; $i < 50; $i++) {
            $nameParts = $faker->words($faker->numberBetween(2, 5));
            $name = ucfirst(implode(' ', $nameParts));
            
            $unitPrice = $faker->randomFloat(2, 5, 500);
            $sellingPrice = $unitPrice * 0.9; // 10% discount
            $wholesalePrice = $unitPrice * 0.7; // 30% discount
            $offerPrice = $faker->boolean(70) ? $unitPrice * $faker->randomFloat(2, 0.5, 0.9) : $unitPrice;

            $features = $faker->words($faker->numberBetween(3, 8));
            $featuresDesc = implode(', ', $features);

            DB::table('products')->insert([
                'category_ids' => json_encode([$faker->randomElement($categories)]),
                'name' => $name,
                'description' => $faker->paragraphs($faker->numberBetween(3, 6), true),
                'short_desc' => $faker->sentence(),
                'unit_price' => $unitPrice,
                'selling_price' => $sellingPrice,
                'wholesale_price' => $wholesalePrice,
                'offer_price' => $offerPrice,
                'features_desc' => $featuresDesc,
                'image' => 'products/default-product-' . $faker->numberBetween(1, 10) . '.jpg',
                'stock_quantity' => $faker->numberBetween(0, 500),
                'in_stock' => $faker->boolean(80), // 80% chance of being in stock
                'status' => $faker->boolean(90), // 90% chance of being active
                'product_unique_identifier' => 'PROD-' . Str::upper(Str::random(8)) . '-' . time(),
                'feature_tag' => $faker->boolean(20), // 20% chance of being featured
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
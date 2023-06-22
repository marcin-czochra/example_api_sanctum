<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
//        Product::factory(20)->create();

        Product::factory(200)->create()->each(function ($product) {

            $numberOfPrices = rand(1, 3);

            for($i=0; $i < $numberOfPrices; $i++) {
                $product->prices()->create([
                    'priceable_id' => $product->id,
                    'priceable_type' => 'App/Model/Product',
                    'value' => rand(100,99999)
                ]);
            }
        });
    }
}

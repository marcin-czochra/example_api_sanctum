<?php

namespace Tests\Feature\Api\V1;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Create categories for products
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        // Create products with associated categories and prices
        $product1 = Product::factory()->create([
            'category_id' => $category1->id,
        ]);
        $product1->prices()->create(['value' => 100]);

        $product2 = Product::factory()->create([
            'category_id' => $category2->id,
        ]);
        $product2->prices()->create(['value' => 200]);
        $product2->prices()->create(['value' => 2400]);

        // Make a GET request to the index method
        $response = $this->get('/api/v1/products');

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the response contains the expected data
        $response->assertJson([
            'data' => [
                [
                    'id' => $product1->id,
                    'category_id' => $product1->category_id,
                    'name' => $product1->name,
                    'description' => $product1->description,
                    'category' => [
                        'id' => $category1->id,
                        'name' => $category1->name,
                    ],
                    'prices' => [
                        [
                            'value' => '1.00',
                        ],
                    ],
                ],
                [
                    'id' => $product2->id,
                    'category_id' => $product2->category_id,
                    'name' => $product2->name,
                    'description' => $product2->description,
                    'category' => [
                        'id' => $category2->id,
                        'name' => $category2->name,
                    ],
                    'prices' => [
                        [
                            'value' => '2.00',
                        ],
                        [
                            'value' => '24.00',
                        ],
                    ],
                ],
            ],
        ]);
    }



}

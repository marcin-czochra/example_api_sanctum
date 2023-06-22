<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    public function testStore()
    {
        // Create a user with an API token
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        // Create a category for the product
        $category = Category::factory()->create();

        // Set up Sanctum authentication with the API token
        Sanctum::actingAs($user, ['*']);

        // Make a POST request to the store method with product data
        $response = $this->post('/api/v1/products', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'category_id' => $category->id,
        ]);

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the response contains the expected data
        $response->assertJson([
            'data' => [
                'name' => 'Test Product',
                'description' => 'This is a test product',
                'category_id' => $category->id,
            ],
        ]);

        // Assert that the product is created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'category_id' => $category->id,
        ]);
    }
}

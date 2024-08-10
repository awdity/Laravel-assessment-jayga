<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function testProductIndex()
    {
        $product = Product::factory()->create();
        $response = $this->get('/api/products');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([$product->toArray()]);
    }

    public function testProductStore()
    {
        $category = Category::factory()->create();
        $response = $this->post('/api/products', [
            'name' => 'Laptop',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJsonFragment(['name' => 'Laptop']);
    }

    public function testProductShow()
    {
        $product = Product::factory()->create();
        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($product->toArray());
    }

    public function testProductUpdate()
    {
        $product = Product::factory()->create();
        $response = $this->put("/api/products/{$product->id}", [
            'name' => 'Updated Laptop',
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonFragment(['name' => 'Updated Laptop']);
    }

    public function testProductDestroy()
    {
        $product = Product::factory()->create();
        $response = $this->delete("/api/products/{$product->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}

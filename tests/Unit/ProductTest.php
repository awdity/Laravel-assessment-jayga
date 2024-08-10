<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testProductCreation()
{
    $category = Category::factory()->create(); // Use factory to create a Category
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $this->assertDatabaseHas('products', [
        'name' => $product->name,
        'category_id' => $category->id,
    ]);
}

public function testProductAttributes()
{
    $product = Product::factory()->create();
    $attribute = Attribute::factory()->create();
    $product->attributes()->attach($attribute);

    $this->assertTrue($product->attributes->contains($attribute));

    }
}

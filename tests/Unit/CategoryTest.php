<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoryCreation()
    {
        $category = Category::create(['name' => 'Electronics']);

        $this->assertDatabaseHas('categories', [
            'name' => 'Electronics',
        ]);
    }
}

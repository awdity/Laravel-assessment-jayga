<?php

namespace Tests\Unit;

use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;

    public function testAttributeCreation()
    {
        $attribute = Attribute::create(['name' => 'Color']);

        $this->assertDatabaseHas('attributes', [
            'name' => 'Color',
        ]);
    }
}

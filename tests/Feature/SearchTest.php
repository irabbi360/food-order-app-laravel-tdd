<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class SearchTest extends TestCase
{
    /** @test */
    public function food_search_page_is_accessible()
    {
        $this->get('/')
            ->assertOk();
    }

    /** @test*/
    public function food_search_page_has_all_the_required_data()
    {
        // Arrange
//        Product::factory()->count(5)->create();

        // Act
        $response = $this->get('/');

        // Assert
        $items = Product::all();

        $response->assertViewIs('search')->assertViewHas('items', $items);
    }
}

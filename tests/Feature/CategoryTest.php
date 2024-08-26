<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $categoryData = [
            'name' => 'Test Category',
        ];

        $response = $this->post('/categories', $categoryData);

        $this->assertDatabaseHas('categories', $categoryData);

        $response->assertStatus(302);
    }

    public function test_guest_user_cannot_create_category()
    {
        $categoryData = [
            'name' => 'Test Category',
        ];

        $response = $this->post('/categories', $categoryData);

        $this->assertDatabaseMissing('categories', $categoryData);

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

}

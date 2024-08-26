<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'title' => 'Updated Post Title',
            'body' => 'Updated post content',
            'slug' => 'updated-post-title',
            'category_id' => $post->category_id,
        ];

        $response = $this->put("/posts/{$post->id}", $updatedData);

        $this->assertDatabaseHas('posts', $updatedData);
        $response->assertStatus(302);
    }

    public function test_guest_user_cannot_create_post()
    {
        $postData = [
            'title' => 'Test Post Title',
            'body' => 'Test post content',
            'slug' => 'test-post-title',
            'category_id' => 1,
        ];

        $response = $this->post('/posts', $postData);

        $this->assertDatabaseMissing('posts', $postData);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_delete_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/posts/{$post->id}");

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
        $response->assertStatus(302);
    }

    public function test_guest_user_cannot_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete("/posts/{$post->id}");

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}

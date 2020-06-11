<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class PostsCommentsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_ten_users(): void
    {
        $this->get('api/v1/posts/1/comments')
            ->assertOk()
            ->assertJsonCount(5);
    }

//    public function test_single_user(): void
//    {
//        $this->get('api/v1/users/1/posts')
//            ->assertSuccessful()
//            ->assertJsonFragment(['name' => 'Patricia Lebsack'])
//            ->assertJsonFragment(['username' => 'Karianne']);
//    }
}

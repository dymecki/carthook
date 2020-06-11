<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class UserPostsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_ten_users(): void
    {
        $this->get('api/v1/users/1/posts')
//            ->assertOk()
            ->assertJsonCount(10);
    }

//    public function test_single_user(): void
//    {
//        $this->get('api/v1/users/1/posts')
//            ->assertSuccessful()
//            ->assertJsonFragment(['name' => 'Patricia Lebsack'])
//            ->assertJsonFragment(['username' => 'Karianne']);
//    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class UsersApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_be_ten_users(): void
    {
        $this->get('api/v1/users')
//            ->assertOk()
            ->assertJsonCount(10);
    }

    public function test_single_user(): void
    {
        $this->get('api/v1/users/4')
//            ->assertSuccessful()
            ->assertJsonFragment(['name' => 'Patricia Lebsack'])
            ->assertJsonFragment(['username' => 'Karianne']);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProtectedRouteByAuth()
    {
        $response = $this->get('/admin/products')->assertRedirect('/login');

        $response->assertStatus(302);
    }
}

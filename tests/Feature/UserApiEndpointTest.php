<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiEndpointTest extends TestCase
{

    /**
     * A basic test for the api end point.
     *
     * @return void
     */
    public function testUserApiEndpoint()
    {
        $response = $this->get('https://reqres.in/api/users?page=1');
        $response->assertStatus(200);
    }
}

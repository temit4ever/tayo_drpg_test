<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\MakeRequests;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UserDataTest extends TestCase
{
  use RefreshDatabase, WithFaker;
  private  $user;
  public function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory()->create();
  }

  /**
   */
    public function testUserApiTest()
    {
      //dd($this->user);
     $this->actingAs($this->user)
       ->getJson(route('user.show', [
           'user' => $this->user->id
         ])
       )
       ->assertStatus(200);

     $this->assertDatabaseHas('users', [
      'first_name' => 'Tee',
    ]);

     $fake_name = $this->faker->firstName;

      $this->actingAs($this->user)
        ->postJson(route('user.store'), [
          'first_name' => 'Ola',
          'last_name' => 'Blue',
        ])->assertOk()
        ->assertStatus(200);
        //$this->assertDatabaseHas('users', ['first_name' => 'Ola']);

        //dd($this->user);

    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Redirect route test
     *
     * @return void
     */
    public function testRedirectRoot()
    {
        $response = $this->get('/');
        $this->assertGuest();

        $response->assertStatus(302);
    }

    /**
     * Unauthorized access test
     *
     * @return void
     */
    public function testAccessCodeCreateGuest() {
        $response = $this->get('/codes/create');

        $response->assertStatus(302);
    }
    
    /**
     * Authorized access test
     *
     * @return void
     */
    public function testAccessCodeCreateAuth() {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['success' => 'bar'])
                         ->get('/codes/create');

        $response->assertStatus(200);
    }

}

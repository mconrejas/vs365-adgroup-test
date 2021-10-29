<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test for a failed login.
     *
     * @return void
     */
    public function testUserFailedLogin()
    {
        $this->json('POST', 'api/login', [
            'email' => 'test@test.com', 
            'password' => 'test'
        ])
        ->seeStatusCode(401);
    }
    
    /**
     * Test for a successful login.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $user = User::factory()->create();

        $this->json('POST', 'api/login', ['email' => $user->email, 'password' => 'password'])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }

    /**
     * Test in accessing /me endpoint.
     *
     * @return void
     */
    public function testUserCanGetMeData()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('api/me')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'name',
                'email',
                'updated_at',
                'created_at'
            ]);
    }
}

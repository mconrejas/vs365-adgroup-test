<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    /**
     * Test in adding a comment.
     *
     * @return void
     */
    public function testCanComment()
    {
        $user = User::factory()->create();

        // Lazy load relations
        $user->load(['ips', 'comments']);

        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        // Create dummy ip data
        $ip = $user->ips()->create([
            'ip' => generateIP(),
            'label' => $faker->catchPhrase
        ]);

        $comment = [ 'comment' =>$faker->sentence ];

        $this->actingAs($user)
            ->json('POST', "api/ip/$ip->id/comment", $comment)
            ->seeStatusCode(201)
            ->seeJson($comment);
    }

    /**
     * Test fail response for unauthenticated request.
     *
     * @return void
     */
    public function testCanNotAccessIfNotAuthenticated()
    {
        $this->json('GET', "api/ip")
            ->seeStatusCode(401);
    }
}

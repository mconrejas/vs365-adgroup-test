<?php

use App\Models\Ip;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class IpTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test in viewing all ip.
     *
     * @return void
     */
    public function testCanViewIpList()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('GET', 'api/ip')
            ->seeStatusCode(200);
    }

    /**
     * Test in creating an ip.
     *
     * @return void
     */
    public function testCanCreateNewIp()
    {
        $user = User::factory()->create();

        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        $data = [
            'ip' => generateIp(),
            'label' => $faker->catchPhrase
        ];

        $this->actingAs($user)
            ->json('POST', 'api/ip', $data)
            ->seeStatusCode(201)
            ->seeJson($data);
    }

    /**
     * Test in creating an ip.
     *
     * @return void
     */
    public function testIpAlreasyExisting()
    {
        $user = User::factory()->create();
        $ip = $user->load('ips')->factory()->create();

        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        $data = [
            'ip' => $ip->ip,
            'label' => $faker->catchPhrase
        ];

        $this->actingAs($user)
            ->json('POST', 'api/ip', $data)
            ->seeStatusCode(422);
    }

    /**
     * Test in viewing ip.
     *
     * @return void
     */
    public function testCanViewSpecificIp()
    {
        $user = User::factory()->create();

        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        $data = [
            'ip' => generateIp(),
            'label' => $faker->catchPhrase
        ];

        // Create dummy data first
        $ip = $user->load('ips')->ips()->create($data);

        $this->actingAs($user)
            ->json('GET', "api/ip/$ip->id")
            ->seeStatusCode(200)
            ->seeJson($data);
    }

    /**
     * Test in updating ip.
     *
     * @return void
     */
    public function testCanUpdateSpecificIp()
    {
        $user = User::factory()->create();

        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        $data = [
            'ip' => generateIp(),
            'label' => $faker->catchPhrase
        ];

        // Create dummy data first
        $ip = $user->load('ips')->ips()->create($data);

        // Change label value before sending request
        $data['label'] = $faker->catchPhrase;

        $this->actingAs($user)
            ->json('PUT', "api/ip/$ip->id", $data)
            ->seeStatusCode(200)
            ->seeJson($data);
    }

    /**
     * Test in viewing non-existing ip.
     *
     * @return void
     */
    public function testSpecificIpNotExisting()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('GET', "api/ip/0")
            ->seeStatusCode(404);
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

<?php

namespace Database\Factories;

use App\Models\Ip;
use Illuminate\Database\Eloquent\Factories\Factory;

class IpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => generateIp(),
            'label' => $this->faker->catchPhrase
        ];
    }
}

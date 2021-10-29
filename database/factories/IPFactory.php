<?php

namespace Database\Factories;

use App\Models\IP;
use Illuminate\Database\Eloquent\Factories\Factory;

class IPFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IP::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip' => mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255),
            'label' => $this->faker->catchPhrase
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'title' => $this->faker->unique()->randomElement(['SEO Guides','Fullstack Language','Digital Marketing']),
            'description' => $this->faker->text(7000),
            'type' => $this->faker->unique()->numberBetween(1, 3),
        ];
    }
}

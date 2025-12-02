<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'category_id' => 1,
            'content' => $this->faker->paragraph(),
            'user_id' => 1,
            'publish' => 1,
            'published_at' => date('Y-m-d H:i:s')
        ];
    }
}

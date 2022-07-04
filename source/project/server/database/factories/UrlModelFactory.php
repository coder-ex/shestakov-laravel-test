<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrlModel>
 */
class UrlModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'caption' => explode(' ', fake('ru_RU')->name(), PHP_INT_MAX)[2],
            'url' => fake()->url
        ];
    }
}

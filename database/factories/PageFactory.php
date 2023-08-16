<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'Page '.fake()->unique()->numberBetween(1, 10);
        $slug = str()->slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'content' => fake()->text(),
        ];
    }
}

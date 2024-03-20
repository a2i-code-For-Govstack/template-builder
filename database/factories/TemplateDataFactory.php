<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TemplateData>
 */
class TemplateDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(),
            'sid' =>  fake()->text(),
            'aid' =>  fake()->text(),
            'userInfo' =>  fake()->paragraph(),
            'formID' => random_int(100000, 999999),
        ];
    }
}

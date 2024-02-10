<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AtmNote;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ATMNote>
 */
class AtmNoteFactory extends Factory
{
    protected $model = AtmNote::class;

    public function definition()
    {
        return [
            'note_value' => $this->faker->randomElement([20, 50]),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}



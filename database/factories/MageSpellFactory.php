<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MageSpellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function magicMissile()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Magic Missile',
                'level' => 1,
                'mc' => 5,
                'damage' => 1,
            ];
        });
    }
}

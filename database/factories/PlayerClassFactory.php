<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerClassFactory extends Factory
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

    public function Warrior()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Warrior',
                'description' => 'Fierce fighter with extreme physical capabilities',
                'base_health' => '90',
                'base_resistance' => '0',
                'base_attack' => '2',
                'base_defence' => '2',
                'special_ability' => 'Double Attack',
            ];
        });
    }

    public function Wizard()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Wizard',
                'description' => 'Inteligent mage with the knowlage of the arcane arts',
                'base_health' => '50',
                'base_resistance' => '2',
                'base_attack' => '0',
                'base_defence' => '0',
                'special_ability' => 'Detect Magic',
            ];
        });
    }

    public function Priest()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Priest',
                'description' => 'Wise cleric with the divine favors from specific deity',
                'base_health' => '75',
                'base_resistance' => '1',
                'base_attack' => '1',
                'base_defence' => '0',
                'special_ability' => 'Turn Undead',
            ];
        });
    }
    
    public function Rogue()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Rogue',
                'description' => 'Dexterious thief with the witty abilities',
                'base_health' => '65',
                'base_resistance' => '0',
                'base_attack' => '1',
                'base_defence' => '3',
                'special_ability' => 'Backstab',
            ];
        });
    }
}


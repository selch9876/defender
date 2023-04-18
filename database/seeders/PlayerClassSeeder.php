<?php

namespace Database\Seeders;

use App\Models\PlayerClass;
use Illuminate\Database\Seeder;

class PlayerClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warrior = PlayerClass::factory()
        ->warrior()
        ->create();

        $wizard = PlayerClass::factory()
        ->wizard()
        ->create();

        $priest = PlayerClass::factory()
        ->priest()
        ->create();

        $rogue = PlayerClass::factory()
        ->rogue()
        ->create();
    }
}

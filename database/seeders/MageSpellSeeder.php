<?php

namespace Database\Seeders;

use App\Models\MageSpell;
use Illuminate\Database\Seeder;

class MageSpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mageSpell = MageSpell::factory()
        ->magicMissile()
        ->create();
    }
}

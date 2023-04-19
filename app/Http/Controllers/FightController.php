<?php

namespace App\Http\Controllers;

use App\Models\Enemy;
use App\Models\Fight;
use App\Models\Round;
use App\Models\Character;
use Illuminate\Http\Request;

class FightController extends Controller
{
    public function start(Character $character, Enemy $enemy)
    {
        // Create a new fight record
        $fight = Fight::create([
            'character_id' => $character->id,
            'enemy_id' => $enemy->id,
            'status' => Fight::STATUS_IN_PROGRESS,
        ]);

        // Initialize the first round
        $round = Round::create([
            'fight_id' => $fight->id,
            'attacker_type' => Round::TYPE_CHARACTER,
            'attacker_id' => $character->id,
            'defender_type' => Round::TYPE_ENEMY,
            'defender_id' => $enemy->id,
        ]);

        // Pass the required data to the view
        return view('game.attack', [
            'fight' => $fight,
            'round' => $round,
            'character' => $character,
            'enemy' => $enemy,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Enemy;
use App\Models\Fight;
use App\Models\Round;
use App\Models\Character;
use App\Models\Monster;
use Illuminate\Http\Request;

class FightController extends Controller
{
    public function fight()
    {
        $fight = Fight::find(request()->get('id'));
        $character = Character::find($fight->character_id);
        $enemy = Monster::find($fight->monster_id);
        return view('game.fight', [
            'fight' => $fight,
            'character' => $character,
            'enemy' => $enemy,
        ]);
    }
    public function attack(Request $request)
    {
        $fight = Fight::findOrFail($request->input('fight_id'));
        $character = $fight->character;
        $monster = $fight->monster;
        $attacker = $request->input('attacker_type') == 'character' ? $character : $monster;
        $defender = $request->input('attacker_type') == 'character' ? $monster : $character;
        $damage = $attacker->attack($defender);
        $defender->takeDamage($damage);
        if ($defender->isDead()) {
            $fight->winner()->associate($attacker);
            $fight->save();
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $round = $fight->getCurrentRound();
        if (!$round->isInProgress()) {
            $nextRoundNumber = $fight->getNextRound();
            $round = new Round();
            $round->number = $nextRoundNumber;
            $round->fight()->associate($fight);
            $round->save();
            $fight->current_round = $round->id;
            $fight->save();
        }
        $round->addTurn($attacker, $defender, $damage);
        return redirect()->route('fight', ['id' => $fight->id]);
    }
}

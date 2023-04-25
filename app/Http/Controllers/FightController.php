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
        $defender = $request->input('attacker_type') == 'monster' ? $character : $monster;
        $attacker = $request->input('attacker_type') == 'player' ? $character : $monster;
        
        $damage = $attacker->attack();
        //dd($damage);
        $defender->takeDamage($damage);
        if ($defender->isDead()) {
            $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage and ' .$defender->name . ' is dead!');
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $round = $fight->getCurrentRound();
        if (!$round->isInProgress()) {
            $nextRoundNumber = $fight->getNextRound();
            $round = new Round();
            $round->number = $nextRoundNumber;
            $round->fight()->save($fight);
            $round->save();
            $fight->current_round = $round->id;
            $fight->save();
        }
        $round->addTurn($attacker, $defender, $damage);
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function win($id)
    {
        $fight = Fight::findOrFail($id);
        $winner = $fight->winner();
        $loser = $fight->loser();
        return view('game.win', [
            'winner' => $winner,
            'loser' => $loser,
        ]);
    }
}

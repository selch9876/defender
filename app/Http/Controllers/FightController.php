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
        $attacker = $character;
        $defender = $monster;
        
        $damage = $attacker->attack();
        $defenderDamage = $defender->attack();
        $defender->takeDamage($damage);
        
        if ($defender->isDead()) {
            $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage and ' .$defender->name . ' is dead!');
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $attacker->takeDamage($defenderDamage);

        if ($attacker->isDead()) {
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' . $damage . ' damage and ' .$attacker->name . ' is dead!');
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage! ' . $defender->name . ' Hits '. $attacker->name. ' for ' . $defenderDamage . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function defend(Request $request)
    {
        $fight = Fight::findOrFail($request->input('fight_id'));
        $character = $fight->character;
        $monster = $fight->monster;
        $attacker = $monster;
        $defender = $character;
        
        $damage = round($attacker->attack() / 2);
        $defenderDamage = round($defender->attack() / 2);
        //dd($damage);
        $defender->takeDamage($damage);
        $heal =  rand(2, 20);
        $smallHeal = round($heal / 3); 
        $defender->heal($smallHeal);
        
        if ($defender->isDead()) {
            $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage and ' .$defender->name . ' is dead!');
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $attacker->takeDamage($defenderDamage);

        if ($attacker->isDead()) {
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' . $damage . ' damage and ' .$attacker->name . ' is dead!');
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . 
        ' damage! ' . $defender->name . ' Hits '. $attacker->name. ' for ' . $defenderDamage . ' damage! ' . $defender->name . ' heals for ' . $smallHeal . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function heal(Request $request)
    {
        $fight = Fight::findOrFail($request->input('fight_id'));
        $character = $fight->character;
        $monster = $fight->monster;
        $attacker = $monster;
        $defender = $character;
        
        $damage = round($attacker->attack() / 2);
        $heal =  rand(2, 20);
        $defender->heal($heal);
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. 
        ' for ' . $damage . ' damage! ' . $defender->name . ' heals for ' . $heal . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function run(Request $request)
    {
        $fight = Fight::findOrFail($request->input('fight_id'));
        $character = $fight->character;
        $monster = $fight->monster;
        $attacker = $monster;
        $defender = $character;
        
        $damage = round($attacker->attack() / 2);
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. 
        ' for ' . $damage . ' damage! ' . $defender->name . ' runs from the battle!');
        return redirect()->route('home');
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

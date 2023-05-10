<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Enemy;
use App\Models\Fight;
use App\Models\Round;
use App\Models\Monster;
use App\Models\Character;
use App\Models\Inventory;
use App\Models\MageSpell;
use Illuminate\Http\Request;

class FightController extends Controller
{
    public function fight()
    {
        $fight = Fight::find(request()->get('id'));
       
        $character = Character::find($fight->character_id);
        
        //$sword = Item::findOrFail(1); // Get the item

       // $character->items()->syncWithoutDetaching([$sword->id => ['quantity' => 1]]);
        $enemy = Monster::find($fight->monster_id);
        return view('game.fight', [
            'fight' => $fight,
            'character' => $character,
            'enemy' => $enemy,
        ]);
    }

    function getFightObjects($fight_id) {
        $fight = Fight::findOrFail($fight_id);
        $attacker = $fight->character;
        $defender = $fight->monster;
        
        return [
            'fight' => $fight,
            'attacker' => $attacker,
            'defender' => $defender,
        ];
    }
  
    
    public function attack(Request $request)
    {
        $data = $this->getFightObjects($request->input('fight_id'));
        $fight = $data['fight'];
        $attacker = $data['attacker'];
        $defender = $data['defender'];
        
        $damage = $attacker->attack();
        $defenderDamage = $defender->attack();
        $defender->takeDamage($damage);
        
        if ($defender->isDead()) {
            $attacker->xp += $defender->xp;
            if (floor($attacker->xp / 100) >= $attacker->level) {
                $dif = ($attacker->xp / 100) - $attacker->level;
                for ($i=0; $i < $dif; $i++) { 
                    $attacker->levelUp();
                }
                
            }
            $attacker->save();
            $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' 
            . $damage . ' damage and ' .$defender->name . ' is dead!');
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $attacker->takeDamage($defenderDamage);
        $attacker->save();
        if ($attacker->isDead()) {
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' 
            . $damage . ' damage and ' .$attacker->name . ' is dead!');
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' 
        . $damage . ' damage! ' . $defender->name . ' Hits '. $attacker->name. ' for ' . $defenderDamage . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function defend(Request $request)
    {
        $data = $this->getFightObjects($request->input('fight_id'));
        $fight = $data['fight'];
        $attacker = $data['attacker'];
        $defender = $data['defender'];
        
        $damage = round($attacker->attack() / 2);
        $defenderDamage = round($defender->attack() / 2);
       
        
        $defender->takeDamage($damage);
        $heal =  rand(5, 20);
        $smallHeal = round($heal / 3); 
        $attacker->heal($smallHeal);
        
        if ($defender->isDead()) {
            $attacker->xp += $defender->xp;
            if (floor($attacker->xp / 100) >= $attacker->level) {
                $attacker->levelUp();
            }
            $attacker->save();
            $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' 
            . $damage . ' damage and ' .$defender->name . ' is dead!');
            return redirect()->route('win', ['id' => $fight->id]);
        }
        $attacker->takeDamage($defenderDamage);
        $realDamage = $attacker->takeDamage($defenderDamage);

        if ($attacker->isDead()) {
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' 
            . $realDamage . ' damage and ' .$attacker->name . ' is dead!');
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
        ' damage! ' . $defender->name . ' Hits '. $attacker->name. ' for ' . $realDamage . ' damage! ' 
        . $attacker->name . ' heals for ' . $smallHeal . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function heal(Request $request)
    {
        $data = $this->getFightObjects($request->input('fight_id'));
        $fight = $data['fight'];
        $attacker = $data['attacker'];
        $defender = $data['defender'];
        
        $damage = round($defender->attack() / 2);
        $heal =  rand(2, 20);
        $attacker->heal($heal);
        $attacker->takeDamage($damage);
        $attacker->save();

        $realDamage = $attacker->takeDamage($damage);
        
        
        if ($attacker->isDead()) {
            $attacker->save();
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' 
            . $realDamage . ' damage and ' .$attacker->name . ' is dead!');
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
        $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. 
        ' for ' . $realDamage . ' damage! ' . $attacker->name . ' heals for ' . $heal . ' damage!');
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    public function run(Request $request)
    {
        $data = $this->getFightObjects($request->input('fight_id'));
        $fight = $data['fight'];
        $attacker = $data['attacker'];
        $defender = $data['defender'];
        
        $damage = round($defender->attack() / 2);
        $attacker->takeDamage($damage);
        $realDamage = $attacker->takeDamage($damage);

        $attacker->save();
        if ($attacker->isDead()) {
            
            $attacker->save();
            $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. ' for ' . $realDamage . 
            ' damage and ' .$attacker->name . ' is dead!');
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
        $request->session()->flash('status', $defender->name . ' Hits '. $attacker->name. 
        ' for ' . $realDamage . ' damage! ' . $attacker->name . ' runs from the battle!');
        return redirect()->route('home');
    }

    public function cast(Request $request)
    {
        $data = $this->getFightObjects($request->input('fight_id'));
        $fight = $data['fight'];
        $attacker = $data['attacker'];
        $defender = $data['defender'];

        $mageSpell = MageSpell::findOrFail($request->input('mage_spell_id'));
        if ($attacker->mp >= $mageSpell->mc) {
            $damage = $attacker->castSpell($mageSpell);
            $defender->takeDamage($damage);
        } else {
            $request->session()->flash('status', "You don't have enough spell power!" );
            return redirect()->route('fight', ['id' => $fight->id]);
        }
        
        if ($defender->isDead()) {
            $attacker->xp += $defender->xp;
            if (floor($attacker->xp / 100) >= $attacker->level) {
                $attacker->levelUp();
            }
            $attacker->save();
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
        $request->session()->flash('status', $attacker->name . ' Hits '. $defender->name. ' for ' . $damage . ' damage! ');
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

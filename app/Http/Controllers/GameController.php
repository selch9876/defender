<?php

namespace App\Http\Controllers;

use App\Models\Fight;
use App\Models\Round;
use App\Models\Monster;
use App\Models\Character;
use App\Models\Dragon;
use App\Models\Goblin;
use App\Models\Orc;
use App\Models\Rat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    { 
        $user = Auth::user();  
        $characters = $user->characters;
        //dd($characters);
        return view('game.index', [
            'characters' => $characters,
        ]);
    }

    public function startGame(Request $request)
    {
        // Retrieve the selected character from the database
        $character = Character::find($request->input('character_id'));

        // Generate a random monster
        $monster = $this->generateEnemy();

        //dd($character);

        // Create a new fight between the character and monster
        $fight = new Fight();
        $fight->character_id = $character->id;
        $fight->monster_id = $monster->id;
        $fight->save();

        // Create a new round
        $round = new Round();
        $round->turn = 1;
        $round->attacker_id = $character->id;
        $round->defender_id = $monster->id;
        $round->fight()->associate($fight);
        $round->save();
        $fight->current_round = $round->id;
        $fight->save();

        // Redirect to the fight view with the fight ID
        return redirect()->route('fight', ['id' => $fight->id]);
    }

    /* public function create(Request $request)
    {
        $enemy = $this->generateEnemy();
        $character = Character::find($request->input('character')) ;
        $fight = new Fight();
        //dd($character);
        return view('game.fight', [
            'enemy' => $enemy,
            'character' => $character,
            'fight' => $fight,
        ]);
    } */

    public static function generateEnemy()
    {
        $enemies = [
            $dragon = new Dragon(),
            $goblin = new Goblin(),
            $orc = new Orc(),
            $rat = new Rat(),
        ];

        $index = rand(0, count($enemies) - 1);
        $enemies[$index]->save();
        return clone $enemies[$index];
          
    }

}

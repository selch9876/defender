<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Enemy;
use App\Models\Fight;
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

    public function create(Request $request)
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
    }

    public static function generateEnemy()
    {
        $enemies = [
            new Enemy('Goblin', 10, 5, 1, 3),
            new Enemy('Orc', 15, 8, 3, 5),
            new Enemy('Troll', 20, 12, 7, 8),
            new Enemy('Dragon', 30, 20, 12, 15),
        ];

        $index = rand(0, count($enemies) - 1);

        return clone $enemies[$index];
    }

}

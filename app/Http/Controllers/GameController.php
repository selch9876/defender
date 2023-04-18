<?php

namespace App\Http\Controllers;

use App\Models\Enemy;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        return view('game.index');
    }

    public function create()
    {
       $enemy = $this->generateEnemy();
        return view('game.create', compact('enemy'));
    }

    public static function generateEnemy()
    {
        $enemies = [
            new Enemy('Goblin', 10, 5, 3),
            new Enemy('Orc', 15, 8, 5),
            new Enemy('Troll', 20, 12, 8),
            new Enemy('Dragon', 30, 20, 15),
        ];

        $index = rand(0, count($enemies) - 1);

        return clone $enemies[$index];
    }
}

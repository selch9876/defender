<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\MageSpell;
use App\Models\PlayerClass;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::orderBy('name')->get(),
            'players' => User::where('role', '!=', 'admin')->get(),
            'classes' => PlayerClass::all(),
            'mageSpells' => MageSpell::all(),
            'items' => Item::all(),
            'quests' => Quest::all(),
        ]);
    }

    public function users(Request $request)
    {
        $users = User::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.users.index',compact('users'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function quests(Request $request)
    {
        $quests = Quest::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.quests.index',compact('quests'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function players(Request $request)
    {
        $players = User::where([
            ['name', '!=', Null],
            ['role', '!=', 'admin'],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.players.index',compact('players'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function playerClasses(Request $request)
    {
        $playerClasses = PlayerClass::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.player-classes.index',compact('playerClasses'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function mageSpells(Request $request)
    {
        $mageSpells = MageSpell::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.mage-spells.index',compact('mageSpells'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function items(Request $request)
    {
        $items = Item::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("created_at", "desc")
        ->paginate(15);

        return view('admin.items.index',compact('items'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }


}

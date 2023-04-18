<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\PlayerClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $characters = $user->characters()->get();
        return view('characters.index', compact('characters'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $playerClasses = PlayerClass::all();
        return view('characters.create', compact('playerClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $character = new Character([
            'name' => $request->input('name'),
            'class_id' => $request->input('class_id'),
            'str' => $request->input('str'),
            'dex' => $request->input('dex'),
            'int' => $request->input('int'),
            'xp' => 0,
            'level' => 1,
        ]);

        $character->hp = $character->playerClass->base_health;
        $character->mp = $character->int * 10;

        $user->characters()->save($character);
        return redirect()->route('character.show', $character->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $character = Character::findOrFail($id);
        return view('characters.show', [
            'character' => $character,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $character = Character::findOrFail($id);
        $playerClasses = PlayerClass::all();
        return view('characters.edit', [
            'character' => $character,
            'playerClasses' => $playerClasses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        $validated['name'] = $request->get('name');
        $validated['class_id'] = $request->get('class_id');
        $validated['str'] = $request->get('str');
        $validated['dex'] = $request->get('dex');
        $validated['int'] = $request->get('int');
        $character ->fill($validated);
       
        $character->hp = $character->playerClass->base_health;
        $character->mp = $character->int * 10;
        
        $character->save();
        $request->session()->flash('status', 'Character Updated');
        return redirect()->route('character.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $character = Character::findOrFail($id);

        $character->delete();

        session()->flash('status', 'Character Deleted!');

        return redirect()->route('character.index');
    }
}

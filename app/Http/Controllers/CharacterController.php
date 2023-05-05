<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\MageSpell;
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

    public function select(Request $request)
    {
        $request->validate([
            'character' => 'required|exists:characters,id',
        ]);

        $user = $request->user();
        $selectedCharacterId = $request->input('character');

        // Store the selected character ID in the session
        $request->session()->put('selected_character_id', $selectedCharacterId);

        return redirect()->route('home');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $playerClasses = PlayerClass::all();
        $mageSpells = MageSpell::all();
        return view('characters.create', [
            'playerClasses' => $playerClasses,
            'mageSpells' => $mageSpells,
        ]);
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
        $character->save();
        $character->mageSpells()->attach($request->mage_spell_id);

        
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
        $mageSpells = MageSpell::all();
        return view('characters.show', [
            'character' => $character,
            'mageSpells' => $mageSpells,
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
        $mageSpells = MageSpell::all();
        $characterMageSpells = $character->mageSpells->pluck('id')->toArray();
        return view('characters.edit', [
            'character' => $character,
            'playerClasses' => $playerClasses,
            'characterMageSpells' => $characterMageSpells,
            'mageSpells' => $mageSpells,
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
        $character->mageSpells()->sync($request->mage_spell_id);
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

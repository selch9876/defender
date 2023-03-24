<?php

namespace App\Http\Controllers;

use App\Models\Character;
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
        return view('characters.create');
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
            'class' => $request->input('class'),
            'xp' => 0,
            'level' => 1,
            'hp' => 100,
            'mp' => 50,
            'str' => 10,
            'dex' => 10,
            'int' => 10,
        ]);

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
        return view('characters.edit', [
            'character' => $character,
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
        $validated['class'] = $request->get('class');
        $character ->fill($validated);
       
        
        $character->save();
        $request->session()->flash('status', 'Character Updated');
        return redirect()->route('character.edit', ['character' => $character->id]);
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

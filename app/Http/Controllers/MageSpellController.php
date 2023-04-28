<?php

namespace App\Http\Controllers;

use App\Models\MageSpell;
use Illuminate\Http\Request;

class MageSpellController extends Controller
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
        $mageSpells = MageSpell::all();
        return view('mage-spells.index', compact('mageSpells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage-spells.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mageSpell = new MageSpell([
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'dice' => $request->input('dice'),
            'mc' => $request->input('mc'),
        ]);

       // dd($playerClass->id);
        $mageSpell->save();
        
        return redirect()->route('mage-spell.show', ['mage_spell' => $mageSpell->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MageSpell  $mageSpell
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mageSpell = MageSpell::findOrFail($id);
        return view('mage-spells.show', [
            'mageSpell' => $mageSpell,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MageSpell  $mageSpell
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mageSpell = MageSpell::findOrFail($id);
        return view('mage-spells.edit', [
            'mageSpell' => $mageSpell,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MageSpell  $mageSpell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mageSpell = MageSpell::findOrFail($id);

        $validated['name'] = $request->get('name');
        $validated['level'] = $request->get('level');
        $validated['damage'] = $request->get('damage');
        $validated['mc'] = $request->get('mc');
        
        $mageSpell ->fill($validated);
       
        
        $mageSpell->save();
        $request->session()->flash('status', 'Spell Updated');
        return redirect()->route('mage-spell.edit', ['mage_spell' => $mageSpell->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MageSpell  $mageSpell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $mageSpell = MageSpell::findOrFail($id);

        $mageSpell->delete();

        $request->session()->flash('status', 'Spell was deleted!');

        return redirect()->route('mage-spell.index');
    }
}

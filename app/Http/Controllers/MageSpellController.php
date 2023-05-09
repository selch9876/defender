<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\MageSpell;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMageSpell;
use Illuminate\Support\Facades\Storage;

class MageSpellController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin'])
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
        return view('admin.mage-spells.index', compact('mageSpells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mage-spells.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMageSpell $request)
    {
        $validated = $request->validated();
        $mageSpell =  MageSpell::create($validated);

        $mageSpellName = preg_replace('/[^A-Za-z0-9\-]/', '_', $mageSpell->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $mageSpell->id .'_'.$fileName.'_'.$mageSpellName . '_MageSpell.' . $ext );
            $mageSpell->image()->save(
                Image::create(['path'=>$path])
            );
        }

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
        return view('admin.mage-spells.show', [
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
        return view('admin.mage-spells.edit', [
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
    public function update(StoreMageSpell $request, $id)
    {
        $mageSpell = MageSpell::findOrFail($id);
        //$this->authorize('update', $mageSpell);
        $validated = $request->validated();
        $mageSpell ->fill($validated);

        $mageSpellName = preg_replace('/[^A-Za-z0-9\-]/', '_', $mageSpell->name);
       
        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $mageSpell->id .'_'.$fileName.'_'.$mageSpellName . '_MageSpell.' . $ext );

            if ($mageSpell->image) {
                Storage::delete($mageSpell->image->path);
                $mageSpell->image->path = $path;
                $mageSpell->image->save();
            } else {
                $mageSpell->image()->save(
                    Image::create(['path'=>$path])
                );
            }
            
        }
        
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
        if ($mageSpell->image) {
            Storage::delete($mageSpell->image->path);
            $mageSpell->image->delete();
        }

        $mageSpell->delete();

        $request->session()->flash('status', 'Spell deleted!');
        
        return redirect()->route('mage-spell.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PlayerClass;
use Illuminate\Http\Request;

class PlayerClassController extends Controller
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
        
        $classes = PlayerClass::all();
        return view('player-classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('player-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $playerClass = new PlayerClass([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'base_health' => $request->input('base_health'),
            'base_resistance' => $request->input('base_resistance'),
            'base_attack' => $request->input('base_attack'),
            'base_defence' => $request->input('base_defence'),
            'special_ability' => $request->input('special_ability'),
        ]);

       // dd($playerClass->id);
        $playerClass->save();
        
        return redirect()->route('player-class.show', ['player_class' => $playerClass->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayerClass  $playerClass
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playerClass = PlayerClass::findOrFail($id);
        return view('player-classes.show', [
            'playerClass' => $playerClass,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerClass  $playerClass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $playerClass = PlayerClass::findOrFail($id);
        return view('player-classes.edit', [
            'playerClass' => $playerClass,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlayerClass  $playerClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $playerClass = PlayerClass::findOrFail($id);

        $validated['name'] = $request->get('name');
        $validated['description'] = $request->get('description');
        $validated['base_health'] = $request->get('base_health');
        $validated['base_resistance'] = $request->get('base_resistance');
        $validated['base_attack'] = $request->get('base_attack');
        $validated['base_defence'] = $request->get('base_defence');
        $validated['special_ability'] = $request->get('special_ability');
        
        $playerClass ->fill($validated);
       
        
        $playerClass->save();
        $request->session()->flash('status', 'Class Updated');
        return redirect()->route('player-class.edit', ['player_class' => $playerClass->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayerClass  $playerClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $playerClass = PlayerClass::findOrFail($id);

        $playerClass->delete();

        $request->session()->flash('status', 'Class was deleted!');

        return redirect()->route('player-class.index');
    }
}

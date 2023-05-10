<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PlayerClass;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlayerClass;
use Illuminate\Support\Facades\Storage;

class PlayerClassController extends Controller
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
        
        $playerClasses = PlayerClass::all();
        return view('admin.player-classes.index', compact('playerClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.player-classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerClass $request)
    {
        $validated = $request->validated();
        $playerClass =  PlayerClass::create($validated);
        $className = preg_replace('/[^A-Za-z0-9\-]/', '_', $playerClass->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $playerClass->id .'_'.$fileName.'_'.$className . '_PlayerClass.' . $ext );
            $playerClass->image()->save(
                Image::create(['path'=>$path])
            );
        }

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
        return view('admin.player-classes.show', [
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
        return view('admin.player-classes.edit', [
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
    public function update(StorePlayerClass $request, $id)
    {
        $playerClass = PlayerClass::findOrFail($id);
        $validated = $request->validated();
        $playerClass ->fill($validated);

        $className = preg_replace('/[^A-Za-z0-9\-]/', '_', $playerClass->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $playerClass->id .'_'.$fileName.'_'.$className . '_PlayerClass.' . $ext );

            if ($playerClass->image) {
                Storage::delete($playerClass->image->path);
                $playerClass->image->path = $path;
                $playerClass->image->save();
            } else {
                $playerClass->image()->save(
                    Image::create(['path'=>$path])
                );
            }
            
        }
       
        
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
        if ($playerClass->image) {
            Storage::delete($playerClass->image->path);
            $playerClass->image->delete();
        }
        $playerClass->delete();

        $request->session()->flash('status', 'Class was deleted!');

        return redirect()->route('admin.player-classes');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\GameObject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameObject;
use App\Models\Quest;
use Illuminate\Support\Facades\Storage;

class GameObjectController extends Controller
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
        $gameObjects = GameObject::all();
        return view('game-objects.index', compact('gameObjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game-objects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameObject $request)
    {
        $validated = $request->validated();
        $gameObject =  GameObject::create($validated);
        if ($request->get('quest_id')) {
            $validated['quest_id'] = $request->get('quest_id');
        }

        $objectName = preg_replace('/[^A-Za-z0-9\-]/', '_', $gameObject->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $gameObject->id .'_'.$fileName.'_'.$objectName . '_Object.' . $ext );
            $gameObject->image()->save(
                Image::create(['path'=>$path])
            );
        }
        

       // dd($playerClass->id);
        $gameObject->save();
        $request->session()->flash('status', 'Object created!');
        return redirect()->route('admin.game-objects', ['gameObject' => $gameObject->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gameObject = GameObject::findOrFail($id);
        return view('admin.game-objects.show', [
            'gameObject' => $gameObject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gameObject = GameObject::findOrFail($id);
        $quests = Quest::all();
        return view('admin.game-objects.edit', [
            'gameObject' => $gameObject,
            'quests' => $quests,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGameObject $request, $id)
    {
        $gameObject = GameObject::findOrFail($id);
        $validated = $request->validated();
        if ($request->get('quest_id')) {
            $validated['quest_id'] = $request->get('quest_id');
        }
        $gameObject ->fill($validated);

        

        $objectName = preg_replace('/[^A-Za-z0-9\-]/', '_', $gameObject->name);
        

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $gameObject->id .'_'.$fileName.'_'.$objectName . '_Object.' . $ext );

            if ($gameObject->image) {
                Storage::delete($gameObject->image->path);
                $gameObject->image->path = $path;
                $gameObject->image->save();
            } else {
                $gameObject->image()->save(
                    Image::create(['path'=>$path])
                );
            }
            
        }
        
        $gameObject->save();
        $request->session()->flash('status', 'Object Updated');
        return redirect()->route('game-object.edit', ['game_object' => $gameObject->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $gameObject = GameObject::findOrFail($id);
        if ($gameObject->image) {
            Storage::delete($gameObject->image->path);
            $gameObject->image->delete();
        }
        $gameObject->delete();

        $request->session()->flash('status', 'Object deleted!');

        return redirect()->route('admin.game-objects');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'value' => $request->input('value'),
            'rarity' => $request->input('rarity'),
            'type' => $request->input('type'),
            'dice' => $request->input('dice'),
            'thumbnail' => $request->input('thumbnail'),
        ]);

        $itemTitle = preg_replace('/[^A-Za-z0-9\-]/', '_', $item->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $item->id .'_'.$fileName.'_'.$itemTitle . '_Item.' . $ext );
            $item->image()->save(
                Image::create(['path'=>$path])
            );
        }
        

       // dd($playerClass->id);
        $item->save();
        $request->session()->flash('status', 'Item created!');
        return redirect()->route('admin.items', ['item' => $item->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.show', [
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.items.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated['name'] = $request->get('name');
        $validated['description'] = $request->get('description');
        $validated['value'] = $request->get('value');
        $validated['rarity'] = $request->get('rarity');
        $validated['type'] = $request->get('type');
        $validated['dice'] = $request->get('dice');
        
        $item ->fill($validated);
       
        
        $item->save();
        $request->session()->flash('status', 'Item Updated');
        return redirect()->route('item.edit', ['item' => $item->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        $request->session()->flash('status', 'Item deleted!');

        return redirect()->route('admin.items');
    }
}

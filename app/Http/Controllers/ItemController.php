<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItem;
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreItem $request)
    {
        $validated = $request->validated();
        $item =  Item::create($validated);

        $itemName = preg_replace('/[^A-Za-z0-9\-]/', '_', $item->name);

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $item->id .'_'.$fileName.'_'.$itemName . '_Item.' . $ext );
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
    public function update(StoreItem $request, $id)
    {
        $item = Item::findOrFail($id);
        $validated = $request->validated();
        $item ->fill($validated);

        $itemName = preg_replace('/[^A-Za-z0-9\-]/', '_', $item->name);
        

        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->guessExtension();
            $fileName = $request->file('thumbnail')->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs('thumbnails', $item->id .'_'.$fileName.'_'.$itemName . '_Item.' . $ext );

            if ($item->image) {
                Storage::delete($item->image->path);
                $item->image->path = $path;
                $item->image->save();
            } else {
                $item->image()->save(
                    Image::create(['path'=>$path])
                );
            }
            
        }
        
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
        if ($item->image) {
            Storage::delete($item->image->path);
            $item->image->delete();
        }
        $item->delete();

        $request->session()->flash('status', 'Item deleted!');

        return redirect()->route('admin.items');
    }
}

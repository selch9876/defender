<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Character;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\View\View
     */
    public function index(Character $character)
    {
        $items = Item::all();
        $gold = $character->gold;
        /* $selectedCharacterId = session()->get('selected_character_id'); */
        $selectedCharacterId = session('selected_character_id');
        $character = Character::findOrFail($selectedCharacterId);
        //dd($character->name);

        return view('shop.index', compact('items', 'gold', 'character'));
    }

    /**
     * Purchase an item from the shop.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function buy(Request $request)
    {
        $item = Item::findOrFail($request->input('item_id'));
        $character = Character::findOrFail($request->input('character_id'));


        if ($character->gold >= $item->price) {
            $character->items()->attach($item);
            $character->gold -= $item->price;
            $character->save();

            return redirect()->route('shop')->with('success', 'Item purchased!');
        }

        return redirect()->route('shop')->with('error', 'Not enough gold to purchase item.');
    }

    public function sell(Request $request)
    {
        $character = Character::findOrFail($request->input('character_id'));
        $item = $character->items->where('id', $request->item_id)->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found in inventory.');
        }
        $price = $item->price * 0.5;
        $character->gold += $price;
        $character->removeItem($item);
        $character->save();
        return redirect()->back()->with('success', 'Item sold successfully!');
    }
}

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
        $character = Character::findOrFail(session('selected_character_id'));

        return view('shop.index', compact('items', 'character'));
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

        if ($character->gold >= $item->value) {
            $pivotRow = $character->items()->where('item_id', $item->id)->first();

            if ($pivotRow) {
                // Item already exists in character's inventory, increment quantity
                $pivotRow->pivot->quantity += 1;
                $pivotRow->pivot->save();
            } else {
                // Item does not exist in character's inventory, attach it with quantity 1
                $character->items()->attach($item, ['quantity' => 1]);
            }

            $character->gold -= $item->value;
            $character->save();

            return redirect()->route('shop')->with('status', 'Item purchased!');
        } else {
            return redirect()->route('shop')->with('status', 'Not enough gold to purchase item.');
        }
    }

    public function sell(Request $request)
    {
        $character = Character::findOrFail($request->input('character_id'));
        $item = $character->items->where('id', $request->input('item_id'))->first();

        if (!$item) {
            return redirect()->back()->with('status', 'Item not found in inventory.');
        }

        $value = round($item->value * 0.5);
        $quantity = $item->pivot->quantity;

        if ($quantity > 1) {
            // If quantity is more than 1, decrement quantity
            $item->pivot->quantity -= 1;
            $item->pivot->save();
        } else {
            // If quantity is 1, detach item from character's inventory
            $character->items()->detach($item);
        }

        $character->gold += $value;
        $character->save();

        return redirect()->back()->with('status', 'Item sold successfully!');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function map()
    {
        $tileset = asset('storage/tilesets/filler.png');
        $width = 4;
        $height = 6;
        $player = [
            
            'image' => 'storage/thumbnails/1_Warrior_1.png_Warrior_PlayerClass.png'
        ];
        $objects = [
            ['x' => 3, 'y' => 5, 'image' => 'storage/objects/scroll.png'],
            ['x' => 7, 'y' => 2, 'image' => 'storage/objects/fire.png'],
            ['x' => 1, 'y' => 8, 'image' => 'storage/objects/chest.png']
        ];

        //dd($map);
        return view('map', compact('tileset', 'width', 'height', 'objects', 'player'));

        
    }
    public function movePlayer(Request $request)
    {
        $x = $request->input('x');
        $y = $request->input('y');
        $player = [
            'x' => $x,
            'y' => $y,
            'image' => 'storage/thumbnails/warrior.png'
        ];
        $width = 10;
        $height = 10;
        $objects = [
            ['x' => 3, 'y' => 5, 'image' => 'storage/objects/tree.png'],
            ['x' => 7, 'y' => 2, 'image' => 'storage/objects/rock.png'],
            ['x' => 1, 'y' => 8, 'image' => 'storage/objects/chest.png']
        ];
        return view('map', compact('width', 'height', 'objects', 'player'));
    }

}

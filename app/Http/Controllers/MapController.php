<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Character;
use App\Models\GameObject;
use App\Models\MapObject;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function map(Request $request)
    {
        $character = Character::findOrFail(session('selected_character_id'));
        $tileset = asset('storage/tilesets/filler.png');
        $width = 5;
        $height = 5;
        $x = $request->input('x');
        $y = $request->input('y');
        $player = [
            'x' => $x,
            'y' => $y,
            'image' => $character->playerClass->image->url()
        ];

        

        $desiredObjectCount = 5; // Number of objects to generate
        $objectTypes = GameObject::all(); // Retrieve all object types from the database
        
        $mapObjects = collect(); // Create an empty collection to store the generated objects
        
        // Generate random objects
            for ($i = 0; $i < $desiredObjectCount; $i++) {
                $randomX = rand(0, $width - 1); // Generate a random x coordinate
                $randomY = rand(0, $height - 1); // Generate a random y coordinate

                // Randomly select an object type
                $randomType = $objectTypes->random();

                // Create an instance of the object and assign coordinates and type
                
                // Create a new image instance and associate it with the object
                $image = new Image();
                $image->path = $randomType->image->path;
                $image->save();

                // Create a new Object instance
                $object = new MapObject();
                $object->name = $randomType->name;
                $object->x = $randomX;
                $object->y = $randomY;
                $object->save();

                // Associate the Image with the Object
                $object->image()->save($image);
                
                

                // Add the object to the collection
                $mapObjects->push($object);
                //dd($object->image);
            }
        

        //dd( rand(0, $height-1 ));
        return view('map', compact('tileset', 'width', 'height', 'mapObjects', 'player'));

    }

    public function deleteMapObjects()
    {
        try {
            // Retrieve all objects associated with the map
            $objects = MapObject::all();

            // Iterate over each object and delete its associated image
            foreach ($objects as $object) {
                $image = $object->image;
                if ($image) {
                    $image->delete();
                }
            }

            // Delete all objects associated with the map
            $objects->each->delete();

            // Return a success message
            return view('/');
            return response()->json(['message' => 'Associated objects and images deleted successfully']);
        } catch (\Exception $e) {
            // Handle any errors that occur during the deletion process
            return response()->json(['error' => 'Failed to delete associated objects and images'], 500);
        }
    }

    public function movePlayer(Request $request)
    {
        $x = $request->input('x');
        $y = $request->input('y');
        $player = [
            'x' => $x,
            'y' => $y,
            'image' => 'storage/thumbnails/1_Warrior_1.png_Warrior_PlayerClass.png'
        ];
        $width = 10;
        $height = 10;
        $objects = GameObject::all();
        
        return view('map', compact('width', 'height', 'objects', 'player'));
    }

    public static function generateObject()
    {
        $objects = [
            $scroll = new GameObject(),
        ];

        $index = rand(0, count($objects) - 1);
        $objects[$index]->save();
        return clone $objects[$index];
          
    }

}

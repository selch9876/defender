<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterSelectedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $selectedCharacterId = session('selected_character_id');
        

        if (!$selectedCharacterId) {
            // Character not selected, redirect to character selection page
            return redirect()->route('character.index');
        }

        // Get the character object and pass it to the controller method
        $character = Character::findOrFail($selectedCharacterId);
        $request->attributes->add(['character' => $character]);

        return $next($request);
    }
}

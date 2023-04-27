@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fight</h1>
        <p>Current round: {{ $fight->current_round }}</p>
        <p>Player: {{ $character->name }}</p>
        <p>Player health: {{ $character->hp }}</p>
        <p>Player Spell Power: {{ $character->mp }}</p>
        <br>
        <p>Enemy: {{ $enemy->name }}</p>
        <p>Enemy health: {{ $enemy->health }}</p>
        <br>

        @if (session('status'))
            <div class="alert alert-success mt-5">
                {{ session('status') }}
            </div>
        @endif

        <form method="post" action="{{ route('fight.attack') }}">
            @csrf
            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
            <input type="hidden" name="character_id" value="{{ $character->id }}">
            <button type="submit">Attack</button>
        </form>

        <form method="post" action="{{ route('fight.defend') }}">
            @csrf
            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
            <input type="hidden" name="character_id" value="{{ $character->id }}">
            <button type="submit">Defend</button>
        </form>

        <form method="post" action="{{ route('fight.heal') }}">
            @csrf
            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
            <input type="hidden" name="character_id" value="{{ $character->id }}">
            <button type="submit">Heal</button>
        </form>

        <form method="post" action="{{ route('fight.run') }}">
            @csrf
            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
            <input type="hidden" name="character_id" value="{{ $character->id }}">
            <button type="submit">Run</button>
        </form>

        @if ($character->mageSpells)
            @forelse ($character->mageSpells as $spell)
                <form method="post" action="{{ route('fight.cast') }}">
                    Cast {{ $spell->name }}
                    @csrf
                    <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                    <input type="hidden" name="mage_spell_id" value="{{ $spell->id }}">
                    <button type="submit">Cast</button>
                </form>
            @empty
                
            @endforelse
            
        @else
            
        @endif
    </div>
@endsection

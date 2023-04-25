@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fight</h1>
        <p>Current round: {{ $fight->current_round }}</p>
        <p>Player: {{ $character->name }}</p>
        <p>Player health: {{ $character->hp }}</p>
        <p>Enemy: {{ $enemy->name }}</p>
        <p>Enemy health: {{ $enemy->health }}</p>

        <form method="post" action="{{ route('fight.attack') }}">
            @csrf
            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
            <input type="radio" name="attacker_type" value="player" checked> Attack<br>
            <input type="radio" name="attacker_type" value="monster"> Defend<br>
            <button type="submit">Next Round</button>
        </form>
    </div>
@endsection

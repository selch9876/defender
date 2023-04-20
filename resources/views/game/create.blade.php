@extends('layouts.app')

@section('content')
    <h1>Start Game</h1>

    <p>Welcome to the game! Your character is {{ $character->name }}.</p>

    <form action="{{ route('fight') }}" method="POST">
        @csrf
        <input type="hidden" name="character_id" value="{{ $character->id }}">
        <input type="hidden" name="monster_id" value="{{ $monster->id }}">
        <button type="submit">Start Fight</button>
    </form>
@endsection

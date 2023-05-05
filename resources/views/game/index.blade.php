@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container text-center mt-3">
        <div class="row">
            <h1>The Defender</h1>
            <img src="#" alt="" class="img-fluid">
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('start-game') }}">
                @csrf
                
                <input type="hidden" name="character_id" value="{{ $character->id }}" id="{{ $character->id }}" required>
                <strong>{{ $character->name }}</strong> (Level {{ $character->level }}  {{ $character->playerClass->name }})
                <br>
                Health: {{ $character->hp }}
                <br>
                    @if ($character->playerClass->id == 2)
                    Mana Power: {{ $character->mp }}
                    <br>
                    @endif
                Experience: {{ $character->xp }}
                        
                <button type="submit">Start Game</button>
                </form>
            </div>
            
        </div>
  
    </div>
</div>


@endsection
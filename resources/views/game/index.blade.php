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
                <ul class="bg-dark text-white">
                    <p>Please choose a character:</p>
                    @foreach ($characters as $character)
                        <li>
                            <input type="radio" name="character_id" value="{{ $character->id }}" id="{{ $character->id }}">
                            <strong>{{ $character->name }}</strong> 
                            <br>
                            Health: {{ $character->hp }}
                            <br>
                            Experience: {{ $character->xp }}
                        </li>
                    @endforeach
                </ul>
                <button type="submit">Start Game</button>
                </form>
            </div>
            
        </div>
  
    </div>
</div>


@endsection
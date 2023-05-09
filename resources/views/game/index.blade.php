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
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{ $character->playerClass->image->url() }}" class="img-fluid rounded-start" alt="..." width="50%">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">{{ $character->name }}</h5>
                          <p class="card-text">Class: {{ $character->playerClass->name }}</p>
                          <p class="card-text">Level: {{ $character->level }}</p>
                          <p class="card-text">HP: {{ $character->hp }}</p>
                          @if ($character->playerClass->id == 2)
                          <p class="card-text">Mana Power: {{ $character->mp }}</p>
                          @endif
                          <p class="card-text"><small class="text-body-secondary">XP: {{ $character->xp }}</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                
                <input type="hidden" name="character_id" value="{{ $character->id }}" id="{{ $character->id }}" required>
                        
                <button type="submit">Start Game</button>
                </form>
            </div>
            
        </div>
  
    </div>
</div>


@endsection
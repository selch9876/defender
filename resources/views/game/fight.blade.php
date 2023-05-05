@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="battle-character">
                    <img src="character.png">
                    <div class="battle-character-info">
                      <h2>{{ $character->name }}</h2>
                      <p>Health: <span id="character-health">{{ $character->hp }}</span></p>
                      <p>Level: <span id="character-health">{{ $character->level }}</span></p>
                      <p>Spell Power: <span id="character-health">{{ $character->mp }}</span></p>
                      @if ($character->getEquippedWeapon())
                      <p>Weapon: <span id="character-health">{{ $character->getEquippedWeapon()->name }}</span></p>
                      @else
                      <p>Weapon: <span id="character-health">None!</span></p>
                      @endif
                      
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="battle-monster">
                    <img src="monster.png">
                    <div class="battle-monster-info">
                      <h2>{{ $enemy->name }}</h2>
                      <p>Health: <span id="monster-health">{{ $enemy->health }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="battle-actions">
                    <form method="post" action="{{ route('fight.attack') }}">
                        @csrf
                    <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                    <button id="attack-button" type="submit">Attack</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="battle-actions">
                    <form method="post" action="{{ route('fight.defend') }}">
                        @csrf
                    <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                    <button id="attack-button" type="submit">Defend</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="battle-actions">
                    <form method="post" action="{{ route('fight.heal') }}">
                        @csrf
                    <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                    <button id="attack-button" type="submit">Heal</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="battle-actions">
                    <form method="post" action="{{ route('fight.run') }}">
                        @csrf
                    <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                    <button id="attack-button" type="submit">Run</button>
                    </form>
                </div>
            </div>
            @if (count($character->mageSpells) != 0)
            <div class="col">
                <div class="battle-actions">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="attack-button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cast Spell
                        </button>
                        <ul class="dropdown-menu">
                            @forelse ($character->mageSpells as $spell)
                            <li><form method="post" action="{{ route('fight.cast') }}">
                            @csrf
                            <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                            <input type="hidden" name="character_id" value="{{ $character->id }}">
                            <input type="hidden" name="mage_spell_id" value="{{ $spell->id }}">
                            <button  type="submit" class="dropdown-item">{{ $spell->name }}</button>
                            </form>
                            @empty
                    
                            @endforelse</li>
                            
                        </ul>
                    </div>
                </div>
            </div>           
            @endif

            <div class="battle-message">
                <p id="battle-message-text">
                  @if (session('status'))
                      <div class="alert alert-success mt-5">
                          {{ session('status') }}
                      </div>
                  @endif
                </p>
            </div>
        </div>
          
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h1>{{ $character->name }} vs {{ $enemy->getName() }}</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>{{ $character->name }}</h3>
            <ul>
                <li>HP: {{ $character->hp }}</li>
                <li>Attack: {{ $character->getAttack() }}</li>
                <li>Defense: {{ $character->getDefence() }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3>{{ $enemy->getName() }}</h3>
            <ul>
                <li>HP: {{ $enemy->getHealth() }}</li>
                <li>Attack: {{ $enemy->getDamage() }}</li>
                <li>Defense: {{ $enemy->getDefence() }}</li>
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h3>Combat Log</h3>
            <ul>
                @foreach ($fight->rounds as $round)
                    <li>
                        @if ($round->attacker_type === \App\Models\Round::TYPE_PLAYER)
                            {{ $character->name }} attacks {{ $enemy->name }} for {{ $round->damage }} damage.
                        @else
                            {{ $enemy->name }} attacks {{ $character->name }} for {{ $round->damage }} damage.
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h3>Actions</h3>
            <form method="POST" action="{{ route('fight') }}">
                @csrf
                <input type="hidden" name="fight_id" value="{{ $fight->id }}">
                <input type="hidden" name="character" value="{{ $character->id }}">
                <input type="hidden" name="enemy" value="{{ $enemy->id }}">
                <input type="submit" class="btn btn-primary" value="Attack">
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container text-center mt-3">
        
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped">
                    <thead>
                        <h3>Hero</h3>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Health') }}</th>
                            <th>{{ __('Class') }}</th>
                            <th>{{ __('Experience') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $character->name}}</td>
                            <td>{{ $character->hp }}</td>
                            <td>{{ $character->playerClass->name }}</td>
                            <td>{{ $character->xp }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="col">
                <table class="table table-dark table-striped">
                    <thead>
                        <h3>Enemy</h3>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Health') }}</th>
                            <th>{{ __('Damage') }}</th>
                            <th>{{ __('Experience') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $enemy->getName() }}</td>
                            <td>{{ $enemy->getHealth() }}</td>
                            <td>{{ $enemy->getDamage() }}</td>
                            <td>{{ $enemy->getExperience() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="{{ route('fight.start') }}" method="POST">
                    @csrf
                    <input type="hidden" name="character" value="{{ $character }}">
                    <input type="hidden" name="enemy" value="{{ $enemy }}">
                    <button type="submit" class="btn btn-primary">Start Fight</button>
                </form>
                
            </div>
        </div>
    </div>
</div>


@endsection
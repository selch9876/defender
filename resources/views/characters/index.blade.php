@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Characters') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('character.create') }}" class="btn btn-primary">{{ __('Create New Character') }}</a>
                        </div>

                        @if($characters->isEmpty())
                            <p>{{ __('You have no characters yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Class') }}</th>
                                        <th>{{ __('Level') }}</th>
                                        <th>{{ __('Experience') }}</th>
                                        <th>{{ __('HP') }}</th>
                                        <th>{{ __('MP') }}</th>
                                        <th>{{ __('STR') }}</th>
                                        <th>{{ __('DEX') }}</th>
                                        <th>{{ __('INT') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="POST" action="{{ route('select-character') }}">
                                    @csrf
                                    @foreach($characters as $character)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="character" value="{{ $character->id }}" id="character" {{$character->id == session('selected_character_id')  ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        {{ $character->name }}
                                                    </label>
                                                </div>    
                                            </td>
                                            <td>{{ $character->playerClass->name }}</td>
                                            <td>{{ $character->level }}</td>
                                            <td>{{ $character->xp }}</td>
                                            <td>{{ $character->hp }}</td>
                                            <td>{{ $character->mp }}</td>
                                            <td>{{ $character->str }}</td>
                                            <td>{{ $character->dex }}</td>
                                            <td>{{ $character->int }}</td>
                                            
                                            <td>
                                                <a href="{{ route('character.show', $character->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('character.edit', $character->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            {{ __('Select') }}
                                        </button>
                                    </form>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

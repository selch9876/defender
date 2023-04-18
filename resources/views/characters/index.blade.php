@extends('layouts.app')

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
                                    @foreach($characters as $character)
                                        <tr>
                                            <td>{{ $character->name }}</td>
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
                                                <form method="POST" action="{{ route('character.destroy', $character->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

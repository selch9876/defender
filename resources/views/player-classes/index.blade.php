@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Classes') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('player-class.create') }}" class="btn btn-primary">{{ __('Create New Class') }}</a>
                        </div>

                        @if($classes->isEmpty())
                            <p>{{ __('You have no classes yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Base Health') }}</th>
                                        <th>{{ __('Base Resistance') }}</th>
                                        <th>{{ __('Base Attack') }}</th>
                                        <th>{{ __('Base Defence') }}</th>
                                        <th>{{ __('Special Ability') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $class)
                                        <tr>
                                            <td>{{ $class->name }}</td>
                                            <td>{{ $class->description }}</td>
                                            <td>{{ $class->base_health }}</td>
                                            <td>{{ $class->base_resistance }}</td>
                                            <td>{{ $class->base_attack }}</td>
                                            <td>{{ $class->base_defence }}</td>
                                            <td>{{ $class->special_ability }}</td>
                                            <td>
                                                <a href="{{ route('player-class.show', $class->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('player-class.edit', $class->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('player-class.destroy', $class->id) }}" class="d-inline">
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

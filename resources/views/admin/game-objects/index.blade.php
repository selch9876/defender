@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Objects') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('game-object.create') }}" class="btn btn-primary">{{ __('Create New Object') }}</a>
                        </div>

                        @if($gameObjects->isEmpty())
                            <p>{{ __('You have no Objetcs yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('x') }}</th>
                                        <th>{{ __('y') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gameObjects as $gameObject)
                                        <tr>
                                            <td>{{ $gameObject->name }}</td>
                                            <td>{{ $gameObject->x }}</td>
                                            <td>{{ $gameObject->y }}</td>
                                            <td class="text-right col-2">
                                                @if ($gameObject->image)
                                                  <img src="{{ $gameObject->image->url() }}" alt="" width="50%">
                                                @else
                                                  <img src="" alt="">
                                                @endif
                                              </td>
                                            <td>
                                                <a href="{{ route('game-object.show', $gameObject->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('game-object.edit', $gameObject->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('game-object.destroy', $gameObject->id) }}" class="d-inline">
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

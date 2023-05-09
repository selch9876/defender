@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Items') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('item.create') }}" class="btn btn-primary">{{ __('Create New Item') }}</a>
                        </div>

                        @if($items->isEmpty())
                            <p>{{ __('You have no Items yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Value') }}</th>
                                        <th>{{ __('Rarity') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Dice') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->value }}</td>
                                            <td>{{ $item->rarity }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->dice }}</td>
                                            <td class="text-right col-2">
                                                @if ($item->image)
                                                  <img src="{{ $item->image->url() }}" alt="" width="50%">
                                                @else
                                                  <img src="" alt="">
                                                @endif
                                              </td>
                                            <td>
                                                <a href="{{ route('item.show', $item->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('item.destroy', $item->id) }}" class="d-inline">
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

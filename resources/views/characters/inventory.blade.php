@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inventory</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Rarity</th>
                    <th>Type</th>
                    <th>Equipped</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($character->items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->rarity }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->pivot->equipped === 'Equipped' ? 'Equipped' : 'Unequipped' }}</td>
                        <td>
                            @if ($item->pivot->equipped === 'Equipped')
                                <form action="{{ route('unequip-item', ['character_id' => $character->id, 'item_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Unequip</button>
                                </form>
                            @else
                                <form action="{{ route('equip-item', ['character_id' => $character->id, 'item_id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Equip</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    
<div class="container">
    <h1>Shop</h1>
    <div class="row">
        <h3>{{ $character->name }}</h3>
        @foreach ($items as $item)
            <div class="col-md-3">
                <div class="card mb-4 box-shadow">
                    <img class="img-fluid" src="{{ $item->image->url() }}" alt="{{ $item->name }}" width="30%">
                    <p>{{ $item->description }}</p>
                    <p>Damage: {{ $item->dice }}</p>
                    <div class="card-body">
                        <h3>{{ $item->name }}</h3>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <form method="post" action="{{ route('shop.buy', $item->id) }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Buy for {{ $item->value }} gold</button>
                                </form>
                                <form method="post" action="{{ route('shop.sell', $item->id) }}">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="character_id" value="{{ $character->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Sell for {{ $item->value / 2 }} gold</button>
                                </form>
                            </div>
                            <small class="text-muted">{{ $item->value }} gold</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
    

    
@endsection

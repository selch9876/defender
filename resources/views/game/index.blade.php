@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container text-center mt-3">
        <div class="row">
            <h1>The Defender</h1>
            <img src="#" alt="" class="img-fluid">
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('game.create') }}">New Game</a>
            </div>
        </div>
    </div>
</div>


@endsection
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success mt-5">
                {{ session('status') }}
            </div>
        @endif
        <h3>Hello {{ Auth::user() ? Auth::user()->name : 'Visitor, please log in or sign up...'}}</h3>
    </div>
</div>

@endsection

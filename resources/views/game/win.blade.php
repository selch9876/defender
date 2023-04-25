@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Congratulations!') }}</div>
                    <div class="card-body">
                        <p>{{ __('You have defeated your opponent!') }}</p>
                        <p>{{ __('Winner:') }} {{ $winner->name }}</p>
                        <p>{{ __('Loser:') }} {{ $loser->name }}</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Return to Home') }}</a>
                        @if (session('status'))
                            <div class="alert alert-success mt-5">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
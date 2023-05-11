@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Available Quests</h1>
        <hr>
        <div class="row">
            @if(session('error',))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success',))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @foreach($quests as $quest)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>{{ $quest->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $quest->description }}</p>
                            <p class="card-text"><strong>Level Required:</strong> {{ $quest->required_level }}</p>
                            <p class="card-text"><strong>Reward Gold:</strong> {{ $quest->reward_gold }}</p>
                            <p class="card-text"><strong>Reward XP:</strong> {{ $quest->reward_exp }}</p>
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="{{ route('quests.accept', $quest->id) }}">
                                @csrf
                                <input type="hidden" name="quest_id" value="{{ $quest->id }}">
                                <button type="submit">Accept Quest</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

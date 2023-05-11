@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $quest->name }}</h1>
        <hr>
        <div class="card">
            <div class="card-header">
                <h5>Description</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $quest->description }}</p>
                <p class="card-text"><strong>Level Required:</strong> {{ $quest->level_required }}</p>
                <p class="card-text"><strong>Reward:</strong> {{ $quest->reward }}</p>
            </div>
        </div>
        @if($quest->requirements)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Requirements</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($quest->requirements as $requirement)
                            <li class="list-group-item">{{ $requirement->description }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('quests.abandon', $quest->id) }}" class="btn btn-danger">Abandon Quest</a>
        </div>
    </div>
@endsection

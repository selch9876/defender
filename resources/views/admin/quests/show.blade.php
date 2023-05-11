@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Quest Details') }}</div>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $quest->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ $quest->description }}" disabled cols="30" rows="10">{{ $quest->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reward_gold" class="col-md-4 col-form-label text-md-right">{{ __('Reward Gold') }}</label>

                            <div class="col-md-6">
                                <input id="reward_gold" type="text" class="form-control" name="reward_gold" value="{{ $quest->reward_gold }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reward_exp" class="col-md-4 col-form-label text-md-right">{{ __('Reward XP') }}</label>

                            <div class="col-md-6">
                                <input id="reward_exp" type="text" class="form-control" name="reward_exp" value="{{ $quest->reward_exp }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="required_level" class="col-md-4 col-form-label text-md-right">{{ __('Required Level') }}</label>

                            <div class="col-md-6">
                                <input id="required_level" type="text" class="form-control" name="required_level" value="{{ $quest->required_level }}" disabled>
                            </div>
                        </div>

                        <!-- Additional player-class details -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('quest.edit', $quest->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('quest.destroy', $quest->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

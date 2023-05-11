@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Quest') }}</div>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('quest.update', $quest->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', optional($quest ?? null)->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="10" rows="10">{{ old('description', optional($quest ?? null)->description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reward_gold" class="col-md-4 col-form-label text-md-right">{{ __('Reward Gold') }}</label>

                                <div class="col-md-6">
                                    <input id="reward_gold" type="number" min="10" class="form-control @error('reward_gold') is-invalid @enderror" name="reward_gold" value="{{ old('reward_gold', optional($quest ?? null)->reward_gold) }}" required autocomplete="reward_gold" autofocus>

                                    @error('reward_gold')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reward_exp" class="col-md-4 col-form-label text-md-right">{{ __('Reward XP') }}</label>

                                <div class="col-md-6">
                                    <input id="reward_exp" type="number" min="10" class="form-control @error('reward_exp') is-invalid @enderror" name="reward_exp" value="{{ old('reward_exp', optional($quest ?? null)->reward_exp) }}" required autocomplete="reward_exp" autofocus>

                                    @error('reward_exp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="required_level" class="col-md-4 col-form-label text-md-right">{{ __('Required Level') }}</label>

                                <div class="col-md-6">
                                    <input id="required_level" type="number" min="1" class="form-control @error('required_level') is-invalid @enderror" name="required_level" value="{{ old('required_level', optional($quest ?? null)->required_level) }}" required autocomplete="required_level" autofocus>

                                    @error('required_level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <!-- Additional character details -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ route('quest.show', $quest->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

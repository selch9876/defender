@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Class') }}</div>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('player-class.update', $playerClass->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', optional($playerClass ?? null)->name) }}" required autocomplete="name" autofocus>

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
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="10" rows="10">{{ old('description', optional($playerClass ?? null)->description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="base_health" class="col-md-4 col-form-label text-md-right">{{ __('Base Health') }}</label>

                                <div class="col-md-6">
                                    <input id="base_health" type="number" min="10" max="100" class="form-control @error('base_health') is-invalid @enderror" name="base_health" value="{{ old('base_health', optional($playerClass ?? null)->base_health) }}" required autocomplete="base_health" autofocus>

                                    @error('base_health')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="base_resistance" class="col-md-4 col-form-label text-md-right">{{ __('Base Resistance') }}</label>

                                <div class="col-md-6">
                                    <input id="base_resistance" type="number" min="0" max="5" class="form-control @error('base_resistance') is-invalid @enderror" name="base_resistance" value="{{ old('base_resistance', optional($playerClass ?? null)->base_resistance) }}" required autocomplete="base_resistance" autofocus>

                                    @error('base_resistance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="base_attack" class="col-md-4 col-form-label text-md-right">{{ __('Base Attack') }}</label>

                                <div class="col-md-6">
                                    <input id="base_attack" type="number" min="0" max="5" class="form-control @error('base_attack') is-invalid @enderror" name="base_attack" value="{{ old('base_attack', optional($playerClass ?? null)->base_attack) }}" required autocomplete="base_attack" autofocus>

                                    @error('base_attack')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="base_defence" class="col-md-4 col-form-label text-md-right">{{ __('Base Defence') }}</label>

                                <div class="col-md-6">
                                    <input id="base_defence" type="number" min="0" max="5" class="form-control @error('base_defence') is-invalid @enderror" name="base_defence" value="{{ old('base_defence', optional($playerClass ?? null)->base_defence) }}" required autocomplete="base_defence" autofocus>

                                    @error('base_defence')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="special_ability" class="col-md-4 col-form-label text-md-right">{{ __('Special Ability') }}</label>

                                <div class="col-md-6">
                                    <input id="special_ability" type="text" class="form-control @error('special_ability') is-invalid @enderror" name="special_ability" value="{{ old('special_ability', optional($playerClass ?? null)->special_ability) }}" required autocomplete="special_ability" autofocus>

                                    @error('special_ability')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">{{ __('Thumbnail') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="thumbnail" class="form-control-file"/>
                                </div>
                            </div>
                            <!-- Additional character details -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ route('player-class.show', $playerClass->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

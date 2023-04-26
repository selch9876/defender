@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Class') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('player-class.update', $mageSpell->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', optional($mageSpell ?? null)->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                                <div class="col-md-6">
                                    <input id="level" type="number" min="1" max="10" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level', optional($mageSpell ?? null)->level) }}" required autocomplete="level" autofocus>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="damage" class="col-md-4 col-form-label text-md-right">{{ __('Damage') }}</label>

                                <div class="col-md-6">
                                    <input id="damage" type="number" min="10" max="100" class="form-control @error('damage') is-invalid @enderror" name="damage" value="{{ old('damage', optional($mageSpell ?? null)->damage) }}" required autocomplete="damage" autofocus>

                                    @error('damage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mc" class="col-md-4 col-form-label text-md-right">{{ __('Mana Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="mc" type="number" min="0" max="500" class="form-control @error('mc') is-invalid @enderror" name="mc" value="{{ old('mc', optional($mageSpell ?? null)->mc) }}" required autocomplete="mc" autofocus>

                                    @error('mc')
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
                                    <a href="{{ route('mage-spell.show', $mageSpell->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Item') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('item.update', $item->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', optional($item ?? null)->name) }}" required autocomplete="name" autofocus>

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
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', optional($item ?? null)->description) }}" required autocomplete="description" autofocus>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>

                                <div class="col-md-6">
                                    <input id="value" type="number" min="1" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value', optional($item ?? null)->value) }}" required autocomplete="value" autofocus>

                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- These two enums defined in config/enum.php file --}}
                            <div class="form-group row">
                                <label for="rarity" class="col-md-4 col-form-label text-md-right">{{ __('Rarity') }}</label>
                                <div class="col-md-6">
                                    <select name="rarity" id="rarity" class="form-control">
                                        @foreach(config('enum.rarity') as $key => $value)
                                            <option value="{{ $value }}" @if($item->rarity == $value || old('rarity') == $value) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                <div class="col-md-6">
                                    <select name="type" id="type" class="form-control">
                                        @foreach(config('enum.type') as $key => $value)
                                            <option value="{{ $value }}" @if($item->type == $value || old('type') == $value) selected @endif>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dice" class="col-md-4 col-form-label text-md-right">{{ __('Dice') }}</label>

                                <div class="col-md-6">
                                    <input id="dice" type="text"  class="form-control @error('dice') is-invalid @enderror" name="dice" value="{{ old('dice', optional($item ?? null)->dice) }}" required autocomplete="dice" autofocus>

                                    @error('dice')
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
                                    <a href="{{ route('mage-spell.show', $item->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

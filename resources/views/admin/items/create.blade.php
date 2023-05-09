@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Item') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

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
                                    <input id="value" type="number" min="1" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="value" autofocus>

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
                                            <option value="{{ $value }}" >
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
                                            <option value="{{ $value }}" >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dice" class="col-md-4 col-form-label text-md-right">{{ __('Dice') }}</label>

                                <div class="col-md-6">
                                    <input id="dice" type="text"  class="form-control @error('dice') is-invalid @enderror" name="dice" value="{{ old('dice') }}" required autocomplete="dice" autofocus>

                                    @error('dice')
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

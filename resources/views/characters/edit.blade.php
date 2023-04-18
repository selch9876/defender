@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Character') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('character.update', $character->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $character->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>

                                <div class="col-md-6">
                                    <select id="class_id" class="form-control @error('class_id') is-invalid @enderror" name="class_id" required>
                                        @foreach($playerClasses as $playerClass)
                                            <option value="{{ $playerClass->id }}" {{$character->class_id == $playerClass->id  ? 'selected' : ''}}>{{ $playerClass->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('class')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="str" class="col-md-4 col-form-label text-md-right">{{ __('Strenght') }}</label>

                                <div class="col-md-6">
                                    <input id="str" type="number" min="10" max="100" class="form-control @error('str') is-invalid @enderror" name="str" value="{{ old('str', $character->str) }}" required autocomplete="str" autofocus>

                                    @error('str')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dex" class="col-md-4 col-form-label text-md-right">{{ __('Dexterity') }}</label>

                                <div class="col-md-6">
                                    <input id="dex" type="number" min="10" max="100" class="form-control @error('dex') is-invalid @enderror" name="dex" value="{{ old('dex', $character->dex) }}" required autocomplete="dex" autofocus>

                                    @error('dex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="int" class="col-md-4 col-form-label text-md-right">{{ __('Inteligence') }}</label>

                                <div class="col-md-6">
                                    <input id="int" type="number" min="10" max="100" class="form-control @error('int') is-invalid @enderror" name="int" value="{{ old('int', $character->int) }}" required autocomplete="int" autofocus>

                                    @error('int')
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
                                    <a href="{{ route('character.show', $character->id) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

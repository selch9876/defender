@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Class Details') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $playerClass->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $playerClass->description }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="base_health" class="col-md-4 col-form-label text-md-right">{{ __('Base Health') }}</label>

                            <div class="col-md-6">
                                <input id="base_health" type="text" class="form-control" name="description" value="{{ $playerClass->base_health }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="base_resistance" class="col-md-4 col-form-label text-md-right">{{ __('Base Resistance') }}</label>

                            <div class="col-md-6">
                                <input id="base_resistance" type="text" class="form-control" name="description" value="{{ $playerClass->base_resistance }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="base_attack" class="col-md-4 col-form-label text-md-right">{{ __('Base Attack') }}</label>

                            <div class="col-md-6">
                                <input id="base_attack" type="text" class="form-control" name="description" value="{{ $playerClass->base_attack }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="base_defence" class="col-md-4 col-form-label text-md-right">{{ __('Base Defence') }}</label>

                            <div class="col-md-6">
                                <input id="base_defence" type="text" class="form-control" name="description" value="{{ $playerClass->base_defence }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="special_ability" class="col-md-4 col-form-label text-md-right">{{ __('Special Ability') }}</label>

                            <div class="col-md-6">
                                <input id="special_ability" type="text" class="form-control" name="description" value="{{ $playerClass->special_ability }}" disabled>
                            </div>
                        </div>

                        <!-- Additional player-class details -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('player-class.edit', $playerClass->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('player-class.destroy', $playerClass->id) }}" method="POST" style="display: inline-block;">
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

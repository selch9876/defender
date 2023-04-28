@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Spell Details') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $mageSpell->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $mageSpell->level }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="base_health" class="col-md-4 col-form-label text-md-right">{{ __('Damage') }}</label>

                            <div class="col-md-6">
                                <input id="base_health" type="text" class="form-control" name="description" value="{{ $mageSpell->damage }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mc" class="col-md-4 col-form-label text-md-right">{{ __('Mana Cost') }}</label>

                            <div class="col-md-6">
                                <input id="mc" type="text" class="form-control" name="mc" value="{{ $mageSpell->mc }}" disabled>
                            </div>
                        </div>

                        <!-- Additional mage-spell details -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('mage-spell.edit', $mageSpell->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('mage-spell.destroy', $mageSpell->id) }}" method="POST" style="display: inline-block;">
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

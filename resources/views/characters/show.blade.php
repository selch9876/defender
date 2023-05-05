@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Character Details') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $character->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->playerClass->name  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Experience') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->xp  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->level  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('HP') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->hp  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('MP') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->mp  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Strenght') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->str  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Dexterity') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->dex  }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Inteligence') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->int  }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Gold') }}</label>

                            <div class="col-md-6">
                                <input id="class" type="text" class="form-control" name="class" value="{{ $character->gold  }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mage_spells" class="col-md-4 col-form-label text-md-right">{{ __('Mage Spells') }}</label>
                            <div class="col-md-6">
                                @forelse ($mageSpells as $mageSpell)
                                <input id="mage_spells" type="text" class="form-control" name="mage_spells" value="{{ $mageSpell->name }}" disabled>
                                @empty
                                    No Spells!
                                @endforelse
                            </div>
                        </div>
                        

                        <!-- Additional character details -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('character.edit', $character->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('character.destroy', $character->id) }}" method="POST" style="display: inline-block;">
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

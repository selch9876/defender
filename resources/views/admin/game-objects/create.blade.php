@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Object') }}</div>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('game-object.store') }}" enctype="multipart/form-data">
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

                            

                            {{-- <div class="form-group row">
                                <label for="x" class="col-md-4 col-form-label text-md-right">{{ __('X') }}</label>

                                <div class="col-md-6">
                                    <input id="x" type="number"  class="form-control @error('x') is-invalid @enderror" name="x" value="{{ old('x') }}" required autocomplete="x" autofocus>

                                    @error('x')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="y" class="col-md-4 col-form-label text-md-right">{{ __('Y') }}</label>

                                <div class="col-md-6">
                                    <input id="y" type="number"  class="form-control @error('y') is-invalid @enderror" name="y" value="{{ old('y') }}" required autocomplete="y" autofocus>

                                    @error('y')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row">            
                                <label for="quest_id" class="col-md-4 col-form-label text-md-right">Select Quest </label>
                                <div class="col-md-6">
                                 <select name="quest_id" class="form-control">
                                    <option value="">-quests-</option>
                                   @foreach($quests as $quest)
                                    <option value="{{ $quest->id }}">{{ $quest->name }}</option>
                                   @endforeach
                                 </select>
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

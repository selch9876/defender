@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Object Details') }}</div>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    <div class="card-body">
                        <div>
                            <img src="{{ $gameObject->image->url()  }}" alt="" class="img-fluid">
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $gameObject->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="x" class="col-md-4 col-form-label text-md-right">{{ __('X') }}</label>

                            <div class="col-md-6">
                                <input id="x" type="text" class="form-control" name="description" value="{{ $gameObject->x }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="x" class="col-md-4 col-form-label text-md-right">{{ __('Y') }}</label>

                            <div class="col-md-6">
                                <input id="y" type="text" class="form-control" name="description" value="{{ $gameObject->y }}" disabled>
                            </div>
                        </div>

                        
                        

                        <!-- Additional item details -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('game-object.edit', $gameObject->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                <form action="{{ route('game-object.destroy', $gameObject->id) }}" method="POST" style="display: inline-block;">
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

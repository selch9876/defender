@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Mage Spells') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('mage-spell.create') }}" class="btn btn-primary">{{ __('Create New Mage Spell') }}</a>
                        </div>

                        @if($mageSpells->isEmpty())
                            <p>{{ __('You have no Mage Spells yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Level') }}</th>
                                        <th>{{ __('Damage') }}</th>
                                        <th>{{ __('Mana Cost') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mageSpells as $spell)
                                        <tr>
                                            <td>{{ $spell->name }}</td>
                                            <td>{{ $spell->level }}</td>
                                            <td>{{ $spell->dice }}</td>
                                            <td>{{ $spell->mc }}</td>
                                            <td>
                                                <a href="{{ route('mage-spell.show', $spell->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                                <a href="{{ route('mage-spell.edit', $spell->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                                <form method="POST" action="{{ route('mage-spell.destroy', $spell->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

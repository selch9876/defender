@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container text-center mt-3">
        <div class="row">
            <h1>Enemy</h1>
            <img src="#" alt="" class="img-fluid">
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Health') }}</th>
                            <th>{{ __('Damage') }}</th>
                            <th>{{ __('Experience') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $enemy->getName() }}</td>
                            <td>{{ $enemy->getHealth() }}</td>
                            <td>{{ $enemy->getDamage() }}</td>
                            <td>{{ $enemy->getExperience() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
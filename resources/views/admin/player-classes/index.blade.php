@extends('layouts.master')

@section('content')

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Classes </h2>
              
              @if (session('status'))
              <div class="alert alert-success mt-5">
                  {{ session('status') }}
              </div>
              @endif

              <ul class="nav navbar-right panel_toolbox">
                <a href="{{ route('player-class.create') }}" class="btn btn-success"><li>Add Class</li></a>
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                
              </p>
              <table id="datatable" class="table table-striped table-bordered" style="width:50%">
                <thead>
                  <tr>
                    <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Base Health') }}</th>
                        <th>{{ __('Base Resistance') }}</th>
                        <th>{{ __('Base Attack') }}</th>
                        <th>{{ __('Base Defence') }}</th>
                        <th>{{ __('Special Ability') }}</th>
                        <th></th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($playerClasses as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->description }}</td>
                            <td>{{ $class->base_health }}</td>
                            <td>{{ $class->base_resistance }}</td>
                            <td>{{ $class->base_attack }}</td>
                            <td>{{ $class->base_defence }}</td>
                            <td>{{ $class->special_ability }}</td>
                            <td class="text-right col-2">
                              @if ($class->image)
                                <img src="{{ $class->image->url() }}" alt="" width="50%">
                              @else
                                <img src="" alt="">
                              @endif
                            </td>
                          <td>
                            <td>
                                <a href="{{ route('player-class.show', $class->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                <a href="{{ route('player-class.edit', $class->id) }}" class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                <form method="POST" action="{{ route('player-class.destroy', $class->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      </div>
            
    </div>
  </div>
</div>
          
        <!-- /page content -->

@endsection




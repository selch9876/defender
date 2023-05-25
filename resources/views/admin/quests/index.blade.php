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
                <a href="{{ route('quest.create') }}" class="btn btn-success"><li>Add Quest</li></a>
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
                    <th>Name</th>
                    <th>Description</th>
                    <th>Reward Gold</th>
                    <th>Reward XP</th>
                    <th>Required Level</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($quests as $quest)
                        <tr>
                            <td>{{ $quest->name }}</td>
                            <td>{{ Str::words($quest->description, 10) }}</td>
                            <td>{{ $quest->reward_gold }}</td>
                            <td>{{ $quest->reward_exp }}</td>
                            <td>{{ $quest->required_level }}</td>
                            <td><a href="{{ route('quest.show', $quest->id) }}" class="btn btn-sm btn-info">View</a></td>
                            <td><a href="{{ route('quest.edit', $quest->id) }}" class="btn btn-sm btn-primary">Edit</a></td>  
                            <td> 
                                <form action="{{ route('quest.destroy', $quest->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quest?')">Delete</button>
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




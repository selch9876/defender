@extends('layouts.master')

@section('title' , 'Yöneticiler')

@section('content')

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Players </h2>
              
              @if (session('status'))
              <div class="alert alert-success mt-5">
                  {{ session('status') }}
              </div>
              @endif

              
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
                    <th class="col-1">Player</th>
                    <th class="col-2">E-Mail</th>
                    <th class="col-1"></th>
                    <th class="col-1"></th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                  @forelse ($players as $key => $player)
                    <td>{{ $player->name }}</td> 
                    <td class="col-2">{{ $player->email }}</td>
                  </tr>
                  @empty
                  No Players yet! 
                  @endforelse
                  
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
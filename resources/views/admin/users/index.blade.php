@extends('layouts.master')

@section('title' , 'Oyuncular')

@section('content')

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Yöneticiler </h2>
              
              @if (session('status'))
              <div class="alert alert-success mt-5">
                  {{ session('status') }}
              </div>
              @endif

              <ul class="nav navbar-right panel_toolbox">
                <a href="{{ route('user.create') }}" class="btn btn-success"><li>Oyuncu Ekle</li></a>
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
                    <th class="col-1">Oyuncu Adı</th>
                    <th class="col-2">E-Posta</th>
                    <th class="col-1"></th>
                    <th class="col-1"></th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                  @forelse ($users as $key => $user)
                    <td>{{ $user->name }}</td> 
                    <td class="col-2">{{ $user->email }}</td>
                    <td class="col-1">
                        @auth
                          @can('update', $user)
                              <a href="{{ route('user.edit', ['user'=>$user->id]) }}" class="btn btn-success">Düzenle</a>
                          @endcan
                        @endauth
                    </td>
                      <td class="col-1">
                        @can('delete', $user)
                          <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                            <input type="submit" value="Sil" class="btn btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?');">
                          </form>
                          @endcan
                      </td>

                  </tr>
                  @empty
                  Henüz hiç Oyuncu yok! 
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
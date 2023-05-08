@extends('layouts.master')

@section('title', 'Defender Dashboard')
    
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">


  <div class="row">
    <div class="col-md-12">
      <h1>Defender game management. </h1>
      
      @errors @enderrors
    </div>

    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-user"></i>
        </div>
        <div class="count">{{  count($users); }}</div>

        <h3><a href="{{ route('admin.users') }}">Admins</a></h3>
        
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-user"></i>
        </div>
        <div class="count">{{  count($players); }}</div>

        <h3><a href="{{ route('admin.players') }}">Players</a></h3>
        
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-user"></i>
        </div>
        <div class="count">{{  count($classes); }}</div>

        <h3><a href="{{ route('admin.player-classes') }}">Classes</a></h3>
        
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-user"></i>
        </div>
        <div class="count">{{  count($mageSpells); }}</div>

        <h3><a href="{{ route('admin.mage-spells') }}">Mage Spells</a></h3>
        
      </div>
    </div>

  </div>


@endsection

@section('scripts')
    
@endsection
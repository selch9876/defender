<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
     
      <ul class="nav side-menu">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Dahsboard </i></a>
          
        </li>
        <li><a><i class="fa fa-user"></i> Admins <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('user.create') }}">Add Admin</a></li>
            <li><a href="{{ route('admin.users') }}">Admins</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-user"></i> Classes <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('player-class.create') }}">Add Class</a></li>
            <li><a href="{{ route('admin.player-classes') }}">Classes</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-user"></i> Mage Spells <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('mage-spell.create') }}">Add Mage Class</a></li>
            <li><a href="{{ route('admin.mage-spells') }}">Mage Spells</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-user"></i> Items <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('item.create') }}">Add Item</a></li>
            <li><a href="{{ route('admin.items') }}">Items</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-user"></i> Players <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('admin.players') }}">Players</a></li>
          </ul>
        </li>
        

        
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->
  
  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    {{-- <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a> --}}
    {{-- <a data-toggle="tooltip" data-placement="top" title="Çıkış Yap" href="{{ route('logout') }}">
      <span class="glyphicon glyphicon-off" aria-hidden="true" onclick="event.preventDefault();
      this.closest('logout-form').submit();"></span>
    </a> --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
      <button class="btn btn-primary" type="submit" value="Logout"></button>
    </form>
  </div>
  <!-- /menu footer buttons -->
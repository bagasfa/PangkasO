<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
    <li id="dashboard" class="">
      <a class="nav-link" href="{{url('/admin-panel/dashboard')}}">
        <i class="fas fa-home"></i><span>Dashboard</span>
      </a>
    </li>
    <li id="history" class="">
      <a href="{{ url('/admin-panel/history') }}">
        <i class="fas fa-history"></i> <span>History</span>
      </a>
    </li>
    @elseif(auth()->user()->id_role == 3)
    <li id="dashboard" class="">
      <a class="nav-link" href="{{url('/owner-panel/dashboard')}}">
        <i class="fas fa-home"></i><span>Dashboard</span>
      </a>
    </li>
    @endif
    <!-- Separation -->
    @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
    <li class="menu-header">Users Management</li>
    @endif
    @if(auth()->user()->id_role == 1)
    <li id="roles" class="">
      <a href="{{ url('/admin-panel/roles') }}">
        <i class="fas fa-key"></i> <span>Roles Management</span>
      </a>
    </li>
    @endif
    @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
    <li id="users" class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown">
        <i class="fas fa-users"></i> <span>Users Data</span>
      </a>
      <ul class="dropdown-menu">
        @if(auth()->user()->id_role == 1)
        <li>
          <a class="nav-link" href="{{url('/admin-panel/admins')}}">
            <i class="fas fa-user-cog"></i> <span>Admin</span>
          </a>
        </li>
        @endif
        <li>
          <a class="nav-link" href="{{url('/admin-panel/owners')}}">
            <i class="fas fa-user-friends"></i> <span>Owner</span>
          </a>
        </li>
        <li>
          <a class="nav-link" href="{{url('/admin-panel/customers')}}">
            <i class="fas fa-users"></i> <span>Customer</span>
          </a>
        </li>
      </ul>
    </li>
    <li id="verify_identity" class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown">
        <i class="fas fa-id-card"></i> <span>Verify Identity</span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="nav-link" href="{{url('/admin-panel/verify-owners')}}">
            <i class="fas fa-user-friends"></i> Owners
          </a>
        </li>
        <li>
          <a class="nav-link" href="{{url('/admin-panel/verify-customers')}}">
            <i class="fas fa-users"></i> Customers
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a class="nav-link" href="{{url('/admin-panel/trasactions-history')}}">
        <i class="fas fa-receipt"></i> <span>Transactions History</span>
      </a>
    </li>
    @endif

    <!-- Owner Menu Sidebar -->
    @if(auth()->user()->id_role == 3 && auth()->user()->verify_status == 'Approved')
    @if($barber->name == NULL)
    <li id="setup">
      <a class="nav-link" href="{{url('/owner-panel/setup-barbershop')}}">
        <i class="fas fa-cogs"></i> <span>Setup Barbershop</span>
      </a>
    </li>
    @else
    <li id="orders">
      <a class="nav-link" href="{{url('/owner-panel/orders')}}">
        <i class="fas fa-receipt"></i> <span>Orders</span>
      </a>
    </li>
    <li class="menu-header">Barbershop Management</li>
    <li id="banner">
      <a class="nav-link" href="{{url('/owner-panel/banner')}}">
        <i class="fas fa-image"></i> <span>Barbershop Banner</span>
      </a>
    </li>
    <li id="hairstyle" class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown">
        <i class="fas fa-cut"></i> <span>Hairstyle Catalog</span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="nav-link" href="{{url('/owner-panel/male-hairstyle')}}">
            <i class="fas fa-mars"></i> <span>Male</span>
          </a>
        </li>
        <li>
          <a class="nav-link" href="{{url('/owner-panel/female-hairstyle')}}">
            <i class="fas fa-venus"></i> <span>Female</span>
          </a>
        </li>
      </ul>
    </li>
    <li id="services">
      <a class="nav-link" href="{{url('/owner-panel/service-pref')}}">
        <i class="fas fa-hand-holding-heart"></i> <span>Service Preferences</span>
      </a>
    </li>
    <li id="transactions">
      <a class="nav-link" href="{{url('/owner-panel/trasactions-history')}}">
        <i class="fas fa-history"></i> <span>Transactions History</span>
      </a>
    </li>
    @endif
    @else
      @if(auth()->user()->id_role == 3)
      <li id="verify" class="">
        <a class="nav-link" href="{{url('/owner-panel/get-verify')}}">
          <i class="fas fa-id-card"></i> <span>Verify Identity</span>
        </a>
      </li>
      @endif
    @endif
  </ul>
</aside>

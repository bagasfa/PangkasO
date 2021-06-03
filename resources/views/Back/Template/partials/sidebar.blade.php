<aside id="sidebar-wrapper">
  <div class="sidebar-brand brand-logo">
    <a href="">{{ config('app.name') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm brand-logo">
    <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li id="dashboard" class="">
      <a class="nav-link" href="{{url('/admin-panel/dashboard')}}">
        <i class="fas fa-home"></i><span>Dashboard</span>
      </a>
    </li>
    <!-- Menu Khusus SuperAdmin -->
    @if(auth()->user()->id_role == 1)
    <li id="history" class="">
      <a href="{{ url('/admin-panel/history') }}">
        <i class="fas fa-history"></i> <span>History</span>
      </a>
    </li>
    @endif
    <!-- Separation -->
    <li class="menu-header">Users Management</li>
    @if(auth()->user()->id_role == 1)
    <li id="roles" class="">
      <a href="{{ url('/admin-panel/roles') }}">
        <i class="fas fa-key"></i> <span>Roles Management</span>
      </a>
    </li>
    @endif
    <li id="users" class="nav-item dropdown">
      <a href="#" class="nav-link has-dropdown">
        <i class="fas fa-users"></i> <span>Users Data</span>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a class="nav-link" href="{{url('/admin-panel/admins')}}">
            <i class="fas fa-user-cog"></i> <span>Admin</span>
          </a>
        </li>
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
    <li id="verify" class="nav-item dropdown">
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

  </ul>
</aside>

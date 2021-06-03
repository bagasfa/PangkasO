@extends('Back.Template.layouts.skeleton')

@section('app')
  <div class="main-wrapper">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      @include('Back.Template.partials.topnav')
    </nav>
    <div class="main-sidebar">
      @include('Back.Template.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="main-content">
      @yield('content')
    </div>
    <footer class="main-footer">
      @include('Back.Template.partials.footer')
    </footer>
  </div>
@endsection

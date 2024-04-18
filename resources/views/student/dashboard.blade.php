@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">
    <div class="sb-color position-relative" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-3 primary-text fs-4 fw-bold text-white text-uppercase">
            <img src="/images/logo.jpg" alt="tcgc-logo" height="40" width="40" style="border-radius: 50%">
            @include('layouts.designation')
        </div>
    
        <div class="list-group list-group-flush ">
            <div class="text-center text-white px-1 py-2" style="background: #2b724f">
                <span>MAIN NAVIGATION</span>
            </div>
            <a href="{{route('StudentHome')}}" class="list-group-item py-3 list-group-item-action second-text {{ Route::currentRouteName() == 'StudentHome' ? 'current' : '' }}">
                <i class="bi bi-house-fill mx-2"></i>Home
            </a>
            <a href="{{route('StudentApplication')}}" class="list-group-item py-3 list-group-item-action second-text {{ Route::currentRouteName() == 'StudentApplication' ? 'current' : '' }}">
                <i class="bi bi-folder-check mx-2"></i>My Application
            </a>
            <a href="{{route('StudentProfile')}}" class="list-group-item py-3 list-group-item-action second-text {{ Route::currentRouteName() == 'StudentProfile' ? 'current' : '' }}">
                <i class="bi bi-person-circle mx-2"></i>Profile
            </a>
            <div class="position-absolute w-100" style="bottom: 1rem;">
                <form method="POST" action="{{ route('logout') }}" id="submit-logout">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action text-danger border-0"><i class="bi bi-box-arrow-right mx-2"></i>Logout</button>
                </form>
            </div>
        </div>
    </div>
    
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg py-2 px-4 d-flex justify-content-between" id="navbar-top">
            <div class="d-flex align-items-center text-white">
                <i class="bi bi-list primary-text fs-4 me-3" id="menu-toggle"></i>
                <h4 class="text-dark mt-2">{{$user_office->office}}</h4>
            </div>
            @livewire('notification')
        </nav>
    
        <div class="container-fluid px-4">
            <div class="row g-3 my-2">
                <div class="p-3 bg-white shadow-sm rounded">
                   @yield('dashboard-content')
                </div>
            </div>
        </div>

        @include('layouts.footer')
    
    </div>
</div>

@endsection
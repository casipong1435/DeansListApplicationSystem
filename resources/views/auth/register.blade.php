@extends('layouts.app')
@section('page-title', 'Register')
@section('content')

@include('auth.partial')

<main class="py-4">
    <div class="container">
        @livewire('register')
    </div>
</main>

@endsection

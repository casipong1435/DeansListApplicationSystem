@extends('official.dashboard')

@section('page-title', 'Application')
@section('page-content', "Dean's List Application")

@section('dashboard-content')
    @switch(auth()->user()->office)
        @case(1)
            @livewire('official.application-info', ['sem' => $sem, 'sy' => $sy])
            @break
        @case(2)
            @livewire('official.vp-applicant', ['sem' => $sem, 'sy' => $sy])
            @break
        @case(3)
        @case(4)
        @case(5)
        @case(6)
        @case(7)
        @case(8)
            @livewire('official.dean-applicant', ['sem' => $sem, 'sy' => $sy])
            @break
    @endswitch
@endsection
{{-- Authenticated users --}}
@extends('layouts.dracula')

@section('content')
    @include('default-banner')

    <section class="w-full py-4 px-6 flex flex-col">
        <h2 class="text-center">Welcome {{ auth()->user()->name }}!</h2>
    </section>
@endsection

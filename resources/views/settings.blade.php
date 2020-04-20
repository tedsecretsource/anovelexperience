@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4">
        <h1 class="text-center">Account & Subscriptions</h1>
        <div>
            <a href="{{ route('password.request') }}">Reset Password</a>
        </div>
    </section>
@endsection

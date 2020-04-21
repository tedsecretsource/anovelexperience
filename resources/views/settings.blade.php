@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4">
        <h1 class="text-center font-gothic-modern">Account & Subscriptions</h1>
        <h1 class="text-center font-gothic-modern-thick">Account & Subscriptions</h1>
        <h1 class="text-center font-gothic-intense">Account & Subscriptions</h1>
        <h1 class="text-center font-gothic-mild">Account & Subscriptions</h1>
        <h1 class="text-center font-gothic-extra-mild">Account & Subscriptions</h1>
        <h1 class="text-center font-bleeding-caps">Account & Subscriptions</h1>
        <div>
            <a href="{{ route('password.request') }}">Reset Password</a>
        </div>
    </section>
@endsection

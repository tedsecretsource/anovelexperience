@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        <p class=" text-2xl">Account</p>
        <ul>
            <li><a href="{{ route('password.request') }}">Reset Password</a></li>
        </ul>
        <p class=" text-2xl">Subscriptions</p>
        <ul>
            @forelse ($user->subscriptions as $sub)
        <li><a href="{{ route('novel.settings', ['id' => $sub->novel->id]) }}">{{ $sub->novel->title }}</a> ({{ $sub->status }})</li>
            @empty
                <li>You don't have any subscriptions. Check out <a href="{{ route('novels') }}">our collection</a> and start reading!</li>
            @endforelse
        </ul>
    </section>
@endsection

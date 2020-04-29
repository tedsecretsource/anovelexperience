@extends('layouts.dracula')

@section('content')
@section('page_title')
Our Collection of Epistolary Novels
@endsection
@include('default-banner')
    <section class="px-6 py-4 w-full">
        <h1>Our Collection of Epistolary Novels</h1>
        <ul>
        @forelse ($novels as $novel)
            <li class="pb-2 text-2xl">
                <a href="{{ route('novel.detail', ['id' => $novel->id]) }}">{{ $novel->title }}</a>
                @if ($user)
                @if ($user->isSubscribed($novel->id))
                    <a class="btn" href="{{ route('novel.settings', ['id' => $novel->id]) }}">(Settings)</a>
                @else
                    <a class="btn" href="{{ route('novel.subscribe', ['id' => $novel->id]) }}">(Subscribe)</a>
                @endif
                @endif
            </li>
        @empty
            <li>We don't have any novels in our collection.</li>
        @endforelse
        </ul>
        <p>Epistolary novels are books in which the story unfolds in the form of journal entries, letters, or other dated media.</p>
        <p>A Novel Experience makes reading these types of books a new, more intimate experience by sending you each entry by email on the (relative) date it appears in the book.
            We say "relative" because you wouldn't want to have to wait until May 3rd to start reading Dracula. Instead, you can start reading immediately
            and you will receive each entry in alignment with the relative dates in the original novel. For example, if you sign up for Dracular on October 1st, you
            will receive the first entry that day (as soon as you subscribe). The second entry in the original novel is May 4th. Accordingly, on A Novel Experience,
            you will receive the second entry a day later, and so on, for the rest of the book.
        </p>
        <p>In the case of Dracula, at the book's pace, it will take almost 6 months to read the book. Since most people would rather read it over the course of
            days or weeks, we also allow you to increase (or decrease) the pace to suit your needs. We even allow you to pause delivery in case you become busy and
            need to put the book down for a few days (or weeks).
        </p>
        <p>As a registered user, you can subscribe to any of the books in this list. There is no cost to register, only to subscribe to a book and that is usually under $6.00.</p>
        <ul>
        @forelse ($novels as $novel)
            <li class="pb-2 text-2xl">
                <a href="{{ route('novel.detail', ['id' => $novel->id]) }}">{{ $novel->title }}</a>
                @if ($user)
                @if ($user->isSubscribed($novel->id))
                    <a class="btn" href="{{ route('novel.settings', ['id' => $novel->id]) }}">(Settings)</a>
                @else
                    <a class="btn" href="{{ route('novel.subscribe', ['id' => $novel->id]) }}">(Subscribe)</a>
                @endif
                @endif
            </li>
        @empty
            <li>We don't have any novels in our collection.</li>
        @endforelse
        </ul>
    </section>
@endsection

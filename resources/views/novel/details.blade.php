@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        @if ($novel)
            @section('page_title')
            {{ $novel->title }} {{ $novel->novel_emoji }} by {{ $novel->author }}
            @endsection
            <h1>{{ $novel->title }} {{ $novel->novel_emoji }}</h1>
            @auth
                @if ( auth()->user()->isSubscribed($novel->id) )
                    <p><a class="btn" href="{{ route('novel.settings', ['id' => $novel->id]) }}">Subscription Settings</a></p>
                @else
                    <p><a class="btn" href="{{ route('novel.subscribe', ['id' => $novel->id]) }}">Subscribe Now</a></p>
                @endif
            @endauth
            <p>{{ $novel->summary }}</p>
            <p><b>Author:</b> {{ $novel->author }}</p>
            <p><b>Published:</b> {{ $novel->published->toFormattedDateString() }}</p>
            <p><b>First Entry:</b> {{ $novel->first_entry_date->toFormattedDateString() }}</p>
            <p><b>Last Entry:</b> {{ $novel->last_entry_date->toFormattedDateString() }}</p>
            <p><b>Duration:</b> about {{ $novel->duration(1, 'human') }}</p>
            <h2>Emails You Will Receive</h2>
            <p>This is a list of entries in the book, by date, that you will receive by email.</p>
            <p>This novel consists of {{ $novel->entries->count() }} entries.</p>
            @forelse ($novel->entries()->orderBy('entry_date')->get() as $entry)
                <p>
                    {{ $entry->entry_date->format('M d') }} - {{ $entry->title }}
                </p>
            @empty
                <p>No entries have been added to this novel yet</p>
            @endforelse
        @else
            <p>We don't have any novels in our collection with that ID.</p>
        @endif
    </section>
@endsection

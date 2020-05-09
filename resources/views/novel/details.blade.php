@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        @if ($novel)
            @section('page_title')
            {{ $novel->title }} {{ $novel->novel_emoji }} by {{ $novel->author }}
            @endsection
            <h1>{{ $novel->title }} {{ $novel->novel_emoji }}</h1>
            <p class="pb-8">
                @auth
                    @if ( auth()->user()->isSubscribed($novel->id) )
                        <a class="btn" href="{{ route('novel.settings', ['id' => $novel->id]) }}">Subscription Settings</a>
                    @else
                        @include('components.CTA', [
                            'btn_text' => 'Subscribe Now',
                            'url' => route('novel.subscribe', [$novel]),
                            'bg_transparent' => false
                        ])
                    @endif
                @endauth
            </p>
            <p>{{ $novel->summary }}</p>
            <p><b>Author:</b> {{ $novel->author }}</p>
            <p><b>Published:</b> {{ $novel->published->toFormattedDateString() }}</p>
            <p><b>First Entry:</b> {{ $novel->first_entry_date->toFormattedDateString() }}</p>
            <p><b>Last Entry:</b> {{ $novel->last_entry_date->toFormattedDateString() }}</p>
            <p class="pb-8 md:pb-12"><b>Duration:</b> about {{ $novel->duration(1, 'human') }}</p>
            <h2>Emails You Will Receive</h2>
            <p>This is a list of entries in the book, by date, that you will receive by email.</p>
            <p>This novel consists of {{ $novel->entries->count() }} entries.</p>
            @forelse ($novel->entries()->orderBy('entry_date')->get() as $entry)
                <p>
                    {{ $entry->entry_date->format('M d') }} - {{ $entry->title }}
                    @role('administrator')
                        <a href="{{ route('entry.preview', [$entry]) }}" target="_blank">(preview email)</a>
                    @endrole
                </p>
            @empty
                <p>No entries have been added to this novel yet</p>
            @endforelse
        @else
            <p>We don't have any novels in our collection with that ID.</p>
        @endif
    </section>
@endsection

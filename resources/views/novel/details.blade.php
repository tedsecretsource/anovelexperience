@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        @if ($novel)
            @section('page_title')
            {{ $novel->title }} {{ $novel->novel_emoji }} by {{ $novel->author }}
            @endsection
            <h1>{{ $novel->title }} {{ $novel->novel_emoji }}</h1>
            <p><b>Author:</b> {{ $novel->author }}</p>
            <p><b>Published:</b> {{ $novel->published->toFormattedDateString() }}</p>
            <p><b>First Entry:</b> {{ $novel->first_entry_date->toFormattedDateString() }}</p>
            <p><b>Last Entry:</b> {{ $novel->last_entry_date->toFormattedDateString() }}</p>
            <p><b>Duration:</b> about {{ $novel->duration(1, 'human') }}</p>
            <p>{{ $novel->summary }}</p>
        @else
            <p>We don't have any novels in our collection with that ID.</p>
        @endif
    </section>
@endsection

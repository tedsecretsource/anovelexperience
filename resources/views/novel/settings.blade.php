@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        @if ($novel)
            @section('page_title')
            Settings for {{ $novel->title }} {{ $novel->novel_emoji }} by {{ $novel->author }}
            @endsection
            <h1>Settings for {{ $novel->title }} {{ $novel->novel_emoji }}</h1>
            <form class="flex flex-col items-start justify-between p-4 bg-white border-gray-50 rounded-md" action="{{ route('novel.settings', ['id'=>$novel->id]) }}" method="POST">
                @csrf
                <label for="pace" class="mb-8">
                    Pace:
                    @include('components.pace_dropdown', [
                        'novel' => $novel,
                        'subscription' => $subscription
                    ])
                </label>
                <label for="status" class="mb-8">
                    Pause Emails:
                    <input type="checkbox" name="status" id="status" value="1" {{ $subscription->status == 'paused' ? 'checked' : ''}}>
                    <p>(Checked means you will not receive emails - uncheck and Save to resume receiving emails)</p>
                </label>
                <button type="submit" class="">Save</button>
            </form>
        @else
            <p>You are not subscribed to this novel.</p>
        @endif
    </section>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.querySelector('#pace').addEventListener('input', (event) => {
                // let duration = document.querySelector('#duration');
                // let text = event.currentTarget.options[event.currentTarget.selectedIndex].dataset.days;
                // duration.innerText = text;
            });
        })
    </script>
@endsection

@component('mail::message', ['theme' => ($theme ?? ''), 'font_url' => ($font_url ?? ''), 'novel' => $entry->novel])
@if ( $entry->title )
# {{ $entry->title }}
@endif

<h4>{{ $entry->entry_date->toFormattedDateString() }}</h4>

{!! $entry->entry !!}

@slot('subcopy')
@component('mail::button', [
    'url' => route('novel.settings', [$entry->novel]),
    'color' => 'red'
])
Subscription Settings
@endcomponent
@endslot

@endcomponent

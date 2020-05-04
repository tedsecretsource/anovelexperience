@component('mail::message', ['theme' => ($theme ?? ''), 'font_url' => ($font_url ?? ''), 'novel' => $entry->novel])
@if ( $entry->title )
# {{ $entry->title }}
@endif

<h4>{{ $entry->entry_date->toFormattedDateString() }}</h4>

{!! $entry->entry !!}

@slot('subcopy')
{!! $entry->editors_note !!}
@component('mail::button', [
    'url' => route('novel.settings', [$entry->novel]),
    'color' => 'red'
])
Subscription Settings
@endcomponent

<div align="center" style="font-size: 16px">This is entry {{ $entry->getMyIndex() + 1 }} of {{ $entry->novel->loadCount('entries')->entries_count }}</div>

{{ $banner ?? '' }}

@endslot

@endcomponent

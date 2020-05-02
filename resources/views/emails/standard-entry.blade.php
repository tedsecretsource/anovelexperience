@component('mail::message', ['theme' => ($theme ?? ''), 'font_url' => ($font_url ?? ''), 'novel' => $entry->novel])
@if ( $entry->title )
# {{ $entry->title }}
@endif

<h4>{{ $entry->entry_date->toFormattedDateString() }}</h4>

{!! $entry->entry !!}

@endcomponent

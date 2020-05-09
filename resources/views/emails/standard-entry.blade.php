@component('mail::message', ['theme' => ($theme ?? ''), 'font_url' => ($font_url ?? ''), 'novel' => $entry->novel])

@if ( $entry->editors_forward )
<div style="font-size: 16px">
    <b>Editor's note:</b> {{ $entry->editors_forward }}
</div>
<hr>
<br>
@endif

@if ( $entry->title )
# {{ $entry->title }}
@endif

<h4>{{ $entry->entry_date->toFormattedDateString() }}</h4>

{!! $entry->entry !!}

@slot('subcopy')

<div align="center" style="font-size: 16px">{!! $entry->editors_note !!}</div>

@component('mail::button', [
    'url' => route('novel.settings', [$entry->novel]),
    'color' => 'red'
])
Subscription Settings
@endcomponent

<div align="center" style="font-size: 16px">This is entry {{ $entry->getMyIndex() + 1 }} of about 135 (we're still adding entries!)<!-- {{ $entry->novel->loadCount('entries')->entries_count }} --></div>

{{ $banner ?? '' }}

@endslot

@endcomponent

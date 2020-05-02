@component('mail::layout')
<link href="{{ $font_url ?? '' }}" rel="stylesheet">
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => isset($novel) ? route('novel.settings', [$novel]) : config('app.url')])
@if ( isset($novel) )
    {{ $novel->novel_emoji }} {{ $novel->title }} via
@endif
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} [{{ config('app.name') }}]({{ env('APP_URL') }}). @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent

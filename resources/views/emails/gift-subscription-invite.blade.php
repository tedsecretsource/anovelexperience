@component('mail::message', ['theme' => ($theme ?? ''), 'font_url' => ($font_url ?? '')])
# Gift Subscription Invitation

Congratulations! {{ $giver_user->name }} has given you
a gift subscription to "{{ $novel->title }}" on
[A Novel Experience]({{ env('APP_URL') }}).

A gift subscription consists of a user based on your email address ({{ $to_user->email }}) and
a paused subscription to a novel. In order to start receiving the novel
by email, you need to do the following:

1. [Reset your password]({{ env('APP_URL') }}) on {{ env('APP_URL') }}
2. Deselect the "Pause" checkbox on the
[{{ $novel->title }} subscription settings]({{ route('novel.settings', [$novel]) }})
page

And that's it!

Once you "unpause" this gift subscription, you will begin to
receive periodic installments of "{{ $novel->title }}". You
can read all about this service and how it works on
[our web site]({{ env('APP_URL') }}).

You have {{ config('anovelexperience.gift_subscription_pending_days') }}
days from the date of this email to accept this
gift. After {{ config('anovelexperience.gift_subscription_pending_days') }}
days this gift subscription will be anonymized
and eligible for deletion, including your email address.

By resetting your password, you agree to the
[Privacy Policy and Terms of Use]({{ env('APP_URL') }}/privacy)
of A Novel Experience.

@component('mail::button', ['url' => route('password.request')])
Reset User Password
@endcomponent

Enjoy reading,

{{ config('app.name') }}
@endcomponent

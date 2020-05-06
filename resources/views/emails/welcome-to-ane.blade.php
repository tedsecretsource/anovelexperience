@component('mail::message')
# Welcome to {{ env('APP_NAME') }}

Dear {{ $user->name }},

We're excited to have you here. We hope this is a fulfilling experience
for you and that you tell your friends about it. Right now, growing is
the only way this site will survive.

Before you do anything else, and if you haven't done so already, please
be sure to subscribe to one of the novels in [our collection (which
currently only consists of Dracula by Bram Stoker)]({{ route('novels') }}).

If you don't subscribe, you'll still be a member of the site, but nothing
will happen. You need to subscribe to a novel to get the emails.

@component('mail::button', ['url' => route('novel.subscribe', ['id' => 7])])
Subscribe to Dracula
@endcomponent

If you have any questions, concerns, or ideas for how we could improve,
please contact us at hello@anovelexperience.email

Thanks again for joining,

[{{ config('app.name') }}]({{ config('APP_URL') }})

PS: please be sure to verify your email address if you haven't done so
already. Otherwise your account could be subject to, well, let's just
say we know Count Dracula well.
@endcomponent

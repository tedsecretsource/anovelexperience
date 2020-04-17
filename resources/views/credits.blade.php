@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4">
        <h1 class="text-center">Credit Where Credit is Due</h1>
        <p>Quite a bit of this project is the result of countless, unpaid hours put in by thousands of people throughout the planet and time, starting with Bram Stoker!</p>
        <p>This is a list off all the people and projects we've used to create this web site, in no particular order.</p>
        <ul class="px-6 list-disc list-outside">
            <li>Dracula by <a href="https://en.wikipedia.org/wiki/Bram_Stoker">Bram Stroker</a></li>
            <li>Tech stack: Laravel, Tailwindcss, and Mailgun</li>
            <li>Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></li>
        </ul>
    </section>
@endsection

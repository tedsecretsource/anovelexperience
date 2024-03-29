@extends('layouts.dracula')

@section('page_title')
Immerse Yourself in Books
@endsection

@section('content')
    @include('default-banner')

    <section class="py-4 px-6 flex flex-col">
        <h2 class="text-center">A New Concept in Entertainment</h2>
    <p class="mb-8">{{ env('APP_NAME') }} is a new concept in entertainment that allows you to read epistolary novels such as <a href="{{ route('novel.detail', ['id' => 7]) }}">Dracula</a> online. By combining the quality of epistolary novels like Bram Stoker’s Dracula with the intimacy of email, we bring you even closer to living the chilling events and dynamic characters. Subscribe now to receive the first 10 chapters for free. You can cancel at any time by contacting us via our contact form.</p>

        @include('components.CTA', [
            'btn_text' => 'Sign Up for a Free Trail',
            'url' => route('register'),
            'bg_transparent' => false
        ])

        <p class="mt-8">Imagine getting an email from Jonathan Harker, the solicitor who first travels to Dracula’s castle. Imagine him describing the climb from the rail station to the top of a mountain in the middle of the night, where the mist divides to reveal Dracula’s castle. Jonathan went to Transylvania to help Count Dracula move to England. Shortly after his arrival, he realized he is not just there to help with a move. <span style="font-weight: bold;">He is the next victim, and he’s writing to you as it’s being revealed!</span></p><p>Espistolary novels are <a style="text-decoration-line: underline;" href="https://en.wikipedia.org/wiki/Epistolary_novel">books written as a series of documents</a>. Each document, often a journal entry or a letter, has a date indicating when it was written. On Dracula.email, we send you each journal entry or letter, in order, to your inbox. You can almost feel Dracula’s cold breath down the back of your neck as you read the email addressed to you.</p>
        <p>Reading Dracula by email takes about 6 months with an entry roughly every few days. Part of the fun is the anticipation of the next email. When will it arrive? Who will it be from? What horror will it describe?!?!</p>
        <p><a class="hover:bg-dracred-500 hover:text-gray-100 hover:no-underline" href="{{ route('register') }}">Sign up now</a> and receive the first 10 entries of Bram Soker’s Dracula for free. No credit card required. If you enjoy what you are reading, simply follow the link in the footer of any entry to buy the entire book. You can cancel your subscription at any time.</p>
    </section>

    <section class="py-4 px-6 flex flex-row flex-wrap items-center justify-center w-full content-between">
        @include('components.blurb', [
            'icon' => 'gift',
            'icon_color' => 'text-gray-100',
            'h2' => 'First 10 Chapters are Free',
            'text' => 'Enjoy the first 10 chapters of Dracula with no obligation. Just click the link in the footer to purchase the rest of the book.'
            ])
        @include('components.blurb', [
            'icon' => 'paper-plane',
            'icon_color' => 'text-gray-100',
            'h2' => 'Cancel Delivery at Any Time',
            'text' => 'You can stop or pause delivery at any time by clicking a link in the footer of every email.'
            ])
        @include('components.blurb', [
            'icon' => 'heartbeat',
            'icon_color' => 'text-dracred-100',
            'h2' => 'Feel the Horror as if You Were There',
            'text' => 'Sit back. Relax, but not too much, as the words from the characters in the book draw you into their world with their words, with their emotions.'
            ])
    </section>

    <section class="py-4 px-6 leading-normal flex flex-col">
        <h2 class="pb-5 text-center">Read Dracula Online</h2>
        <h3 class="text-center">Receive emails addressed to you from the characters that lived the experience, right in your inbox!</h3>
        <p class="text-left">Want to read Dracula online? Sign up for free and embark on the most incredible reading experience: read the classic gothic novel Dracula at the pace of the story and immerse yourself into the world of the most horrific vampire! </p>
        <p class="text-left">The 1897 Gothic horror classic from Bram Stoker is an epistolary novel; it consists of a collection of diary entries, letters, and other materials written by the characters of the story. From the moment you sign up, you will start receiving by email the pieces that comprise the novel at the pace they were written. You will start experiencing the most fantastic reading immersion you have ever had.</p>
        <p class="text-left"><a href="{{ route('register') }}">Sign up for free now</a>, and the first entry in Jonathan Harker’s journal will be waiting for you in your inbox. Be prepared to get hooked!</p>
    </section>

    <section class="py-4 px-6 mt-1 flex flex-row flex-wrap items-center justify-center w-full content-between">
        @include('components.testimonial', [
            'quote' => 'I\'ve always wanted to read Dracula but never found a way to get all the way through it. Pacing and delivery by email has made all the difference!',
            'name'  => 'Lisette Yeager',
            'job_title' => 'Mom',
            'image_url' => 'images/lisette.jpg'
            ])

@include('components.testimonial', [
    'quote' => 'At first I thought this was an interesting way to read a classic, but then, by about the 5th entry, I was hooked and couldn\'t wait to check my mail to see if there was anything new!',
    'name'  => 'Hanna',
    'job_title' => 'HR Manager',
    'image_url' => 'images/hanna.jpg'
    ])

@include('components.testimonial', [
    'quote' => 'Really fun! I love the way the email design draws me in to the story and I get a small kick every time I see the message addressed to me.',
    'name'  => 'Roger Johnson',
    'job_title' => 'Bartender',
    'image_url' => 'images/roger.jpg'
    ])
</section>

<section class="py-4 px-6 mt-1 mb-8 flex flex-row flex-wrap items-center justify-center w-full content-between">
        @include('components.CTA', [
            'btn_text' => 'Sign Up for Free Trail',
            'url' => route('register'),
            'bg_transparent' => false
        ])
    </section>


@endsection

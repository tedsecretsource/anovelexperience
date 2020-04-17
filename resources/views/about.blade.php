@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        <h1>Our Team</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="flex flex-col items-center">
                <div class="max-w-sm">
                    <img class="max-w-sm self-center" src="images/Julien-Read-Dracula-Online.jpeg" alt="Julien Leleviere">
                    <h2>Julien Leleviere</h2>
                    <p>Visionary</p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="max-w-sm">
                    <img class="max-w-sm self-center" src="images/Ted-Agaete-Sunglasses-1468x1536.jpeg" alt="Ted Stresen-Reuter">
                    <h2>Ted Stresen-Reuter</h2>
                    <p>Programmer</p>
                </div>
            </div>
        </div>
    </section>
@endsection

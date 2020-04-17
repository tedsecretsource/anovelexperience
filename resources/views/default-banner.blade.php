<section class="w-full flex flex-col h-auto px-6 py-16 mb-8 bg-cover bg-no-repeat bg-center bg-gray-500 items-center text-white text-center font-sans transition duration-500 ease-in-out shadow-2xl" style="background-image: url(/images/Draculas-Castle.jpg); background-blend-mode: multiply;">
    <p class="text-dracred-100 sm:text-4xl md:text-5xl lg:text-6xl font-semibold pb-5 uppercase text-center">A Novel Experience</p>
    <p class="text-xl sm:text-xl md:text-2xl lg:text-3xl font-semibold uppercase pb-5">Read epistolary novels by email</p>
    <p class="text-lg sm:text-lg md:text-xl lg:text-2xl  font-semibold uppercase pb-12">Live the events, as they occur, in real time</p>
    @auth
    @else
    @include('components.CTA', [
        'btn_text' => 'Sign Up for a Free Trail',
        'url' => route('register'),
        'bg_transparent' => true
        ])
    @endauth
</section>

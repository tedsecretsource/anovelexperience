<section class="bg-gray-500 h-auto px-6 py-16 bg-cover bg-no-repeat bg-center w-full flex flex-col  items-center text-white text-center font-sans transition duration-500 ease-in-out" style="background-image: url(images/Draculas-Castle.jpg); background-blend-mode: multiply;">
    <h1 class="pb-5 xl:text-6xl uppercase text-center">A Novel Experience</h1>
    <h2 class="uppercase pb-5">Read epistolary novels by email</h2>
    <h2 class="uppercase pb-12">Live the events as they occur in real time</h2>
    @include('components.CTA', [
        'btn_text' => 'Sign Up for a Free Trail',
        'url' => route('register'),
        'bg_transparent' => true
        ])
</section>

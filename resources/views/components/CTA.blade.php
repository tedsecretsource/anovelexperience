<a href="{{ $url }}" class="
    p-3
    self-center
    transition duration-500 ease-in-out transform
    hover:scale-150
    @if (true === $bg_transparent)
        hover:bg-transparent
    @endif
    hover:text-gray-100 hover:border-dracred-100
    bg-dracred-100 text-xl md:text-3xl text-gray-100
    font-sans font-semibold
    border-4 border-transparent rounded
    shadow
    no-underline">{{ $btn_text }}</a>

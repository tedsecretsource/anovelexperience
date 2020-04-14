@if ( 'reverse' === $style )
    <a href="{{ $url }}" class="scale-150 max-w-xl hover:bg-transparent bg-dracred-100 text-xl md:text-3xl text-gray-100 hover:text-gray-100 font-semibold py-4 px-6 border-4 hover:border-dracred-100 border-transparent rounded">{{ $btn_text }}</a>
@else
    <a href="{{ $url }}" class="transition duration-500 ease-in-out transform hover:scale-150 hover:bg-transparent bg-dracred-100 text-xl md:text-3xl text-gray-100 hover:text-gray-100 font-semibold py-4 px-6 border-4 hover:border-dracred-100 border-transparent rounded">{{ $btn_text }}</a>
@endif

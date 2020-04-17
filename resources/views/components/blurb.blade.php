<div class="max-w-xs px-4 py-2 m-3 flex flex-col items-center bg-black text-gray-100 text-center rounded-md shadow-lg" style="width: 300px; height: 300px">
<div class="w-12 m-4 {{ $icon_color }}">
        @includeWhen( 'gift' === $icon, 'svgs.gift')
        @includeWhen( 'paper-plane' === $icon, 'svgs.paper-plane')
        @includeWhen( 'heartbeat' === $icon, 'svgs.heartbeat')
    </div>
    <h2 class="text-2xl">{{ $h2 }}</h2>
    <p class="text-base text-left leading-relaxed font-sans">{{ $text }}</p>
</div>

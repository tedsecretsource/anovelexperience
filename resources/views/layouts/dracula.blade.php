<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') - {{ config('app.name', 'Laravel') }}</title>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js-head')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/animations.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-serif">

    <div class="bg-dracgrey x-screen text-white">

        @if(Route::has('login'))

        <nav x-data="{ open: false }" class="bg-dracgrey font-sans">
        <div class="max-w-screen-lg mx-auto ">
            <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0">
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex">
                        <a href="{{ route('welcome') }}" class="px-3 py-2 rounded-md text-sm font-medium leading-5 {{ Route::currentRouteName() == 'welcome' ? 'bg-gray-900 text-white' : 'text-gray-300' }} focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Home</a>
                        <a href="{{ route('novels') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 {{ Route::currentRouteName() == 'novels' ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Epistolary Novels</a>
                    </div>
                </div>
            </div>
            @auth
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div @click.away="open = false" class="ml-3 relative pr-2" x-data="{ open: false }">
                    <div>
                        <button @click="open = !open" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out">
                            @include('svgs.user')
                        </button>
                    </div>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 pr-2 w-48 rounded-md shadow-lg">
                        <div class="py-1 rounded-md bg-white shadow-xs">
                            <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Settings</a>
                            @auth
                            @if (auth()->user()->hasRole('administrator'))
                                <a href="{{ backpack_url() }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Dracula's Castle</a>
                            @endif
                            @endauth
                            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="pr-6">
                <!-- login link -->
                <a href="{{ route('login') }}" class="no-underline hover:underline text-lg font-normal uppercase pr-6 text-gray-100">{{ __('Login') }}</a>
                @if (Route::has('register'))
                <!-- register link -->
                <a href="{{ route('register') }}" class="no-underline hover:underline text-lg font-normal uppercase text-gray-100">{{ __('Register') }}</a>
                @endif
            </div>
            @endauth
        </div>
    </div>
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="px-2 pt-2 pb-3">
            <a href="{{ route('welcome') }}" class="px-3 py-2 rounded-md text-sm font-medium leading-5 {{ Route::currentRouteName() == 'welcome' ? 'bg-gray-900 text-white' : 'text-gray-300' }} focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Home</a>
            <a href="{{ route('novels') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 {{ Route::currentRouteName() == 'novels' ? 'bg-gray-900 text-white' : 'text-gray-300' }} hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Epistolary Novels</a>
        </div>
    </div>
</nav>
@endif

</div>

    @if (session('system-feedback'))
        <div class="p-2 w-full bg-green-100 border-green-300 border-2 font-sans text-2xl ">{{ session('system-feedback') }}</div>
    @endif

    <div id="main-content" class="max-w-screen-lg mx-auto">

        <main class="flex flex-col items-center">
            @yield('content')
        </main>
    </div>

    <div class="bg-dracgrey x-screen text-white h-12 mt-12 mx-auto flex flex-col items-center">
        <nav class="py-4 px-6 flex flex-row flex-wrap font-sans w-full text-center">
            <a class="text-white w-1/3" href="{{ route('credits') }}">Site Credits</a>
            <a class="text-white w-1/3" href="{{ route('privacy') }}">Privacy Policy</a>
            <a class="text-white w-1/3" href="{{ route('about') }}">About</a>
        </nav>
    </div>
    <p class="bg-dracgrey x-screen text-white font-sans text-center">© 2020 A Novel Experience</p>
@yield('js-footer')
</body>
</html>

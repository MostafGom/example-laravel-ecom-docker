@props(['status'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('/js/select2.min.js') }}"></script>

</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div> --}}



    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @if (request()->ajax())
        @else
            @include('layouts.sidebar')
        @endif

        <div class="flex-1 flex flex-col overflow-hidden">
            @if (request()->ajax())
            @else
                @include('layouts.header')
            @endif

            {{-- 
                @if (session('message'))
                <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <p class="font-bold">{{ session('message') }}</p>
                    </div>
                </div>
                @endif --}}

            <main class="overflow-x-hidden overflow-y-auto bg-gray-200">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <div class="container mx-auto px-6 py-8">

                    @if (session('status'))
                        <div
                            {{ $attributes->merge(['class' => 'font-bold text-lg text-white dark:text-white text-center bg-red-800']) }}>
                            {{ session('status') ?? '' }}
                        </div>
                    @endif

                    {{-- @yield('body') --}}
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>



    @livewireScripts

    {{--  --}}
    @stack('scriptafter')
</body>

</html>

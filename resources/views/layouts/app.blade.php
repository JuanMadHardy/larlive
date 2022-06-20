<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">--}}
        {{--<link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">--}}
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />


        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="{{ asset('js/moment-with-locales.js') }}"></script>
        {{--<script src="D:\laragon\www\larlive\node_modules\flowbite\dist\flowbite.js"></script>--}}
        <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>

        <script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        {{--<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>--}}
    </body>
</html>

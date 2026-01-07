<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    @isset($header)
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main>
        {{ $slot }}
    </main>
</div>
<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 5000)"
     x-show="show"
     style="position: fixed; bottom: 20px !important; right: 20px !important; z-index: 9999; display: flex; flex-direction: column; gap: 10px;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    @if (session('success'))
    <div style="background-color: #10b981; color: white; padding: 16px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 12px; min-width: 300px;">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <h4 style="font-weight: bold; margin: 0; font-size: 16px;">Success</h4>
            <p style="margin: 0; font-size: 14px;">{{ session('success') }}</p>
        </div>
        <button @click="show = false" style="margin-left: auto; color: white; background: none; border: none; cursor: pointer; font-size: 18px;">✕</button>
    </div>
    @endif

    @if (session('error'))
    <div style="background-color: #ef4444; color: white; padding: 16px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 12px; min-width: 300px;">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
        </svg>
        <div>
            <h4 style="font-weight: bold; margin: 0; font-size: 16px;">Error</h4>
            <p style="margin: 0; font-size: 14px;">{{ session('error') }}</p>
        </div>
        <button @click="show = false" style="margin-left: auto; color: white; background: none; border: none; cursor: pointer; font-size: 18px;">✕</button>
    </div>
    @endif

</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <nav class="bg-gradient-to-l from-blue-600 via-sky-600 to-blue-700 p-8">
        <div class="flex justify-between items-center">

        <div class="flex items-center text-white text-lg font-bold">
            <div>
                <a href="/">
                    <x-application-logo class="fill-current w-16 h-16 text-sky-500" />
                </a>
                </div>

               <div class="ml-16">
                
           <a href="{{ route('dashboard') }}" class=" hover:text-sky-300 mx-4 @if(request()->routeIs('dashboard')) border-b-4 border-sky-200  @endif">
                {{ __('Dashboard') }}

           </a>
            </div>
            <div>
            <a href="{{ route('type.index') }}" class=" hover:text-sky-300 mx-12 @if(request()->routeIs('type.index')) border-b-4 border-sky-200  @endif">
                {{ __('Available types') }}

            </a>
            </div>

            </div>
            <div class="flex items-center space-x-4">
               <div class="text-white items-center mx-4"><a href="{{ route('change_lang', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="hover:text-teal-300"><i class="fa-solid fa-globe"></i>  {{ app()->getLocale() }} </a></div>
               @auth
             <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth


            </div>
        </div>
    </nav>
</body>
</html>
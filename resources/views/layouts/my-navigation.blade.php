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
                
           <a href="{{ route('all_posts') }}" class=" hover:text-sky-300 mx-4 @if(request()->routeIs('all_posts')) border-b-4 border-sky-200  @endif">
                {{ __('Posts') }}

            </a>
           
            </div>

            <div class="ml-12">
            <a href="{{ route('contact_us') }}" class="hover:text-sky-300 @if(request()->routeIs('contact_us')) border-b-4 border-sky-200  @endif">
                {{ __('Contact Us') }}
            </a>
            </div>

           

            </div>
            <div class="flex items-center space-x-4">
                @guest
                @if(Route::has('login'))
                <div class="text-white text-lg underline mx-2"> <a href="{{ route('login') }}" class="hover:text-[#14DED1]">{{ __('Login') }}</a> </div>
              @endif
              @if(Route::has('register'))
                <div> <a href="{{ route('register') }}"> <x-primary-button class="focus:bg-teal-300 hover:bg-teal-300 active:bg-teal-300 bg-teal-400">{{ __('Register') }}</x-primary-button> </a> </div>
                @endif
               @endguest
               <div class="text-white items-center mx-2"><a href="{{ route('change_lang', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="hover:text-teal-300"><i class="fa-solid fa-globe"></i>  {{ app()->getLocale() }} </a></div>
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

                    <x-dropdown-link :href="route('saved_posts')">
                            {{ __('Saved posts') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

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
<x-admin-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Create type') }}
        </h2>
    </x-slot>

    <form action="{{ route('type.store') }}" method="POST" class="p-8 min-h-screen">
        @csrf
        <x-input-label class="text-xl font-semibold">{{ __('Name') }}<span class="text-red-600">*</span></x-input-label>
        <x-text-input name="name" dir="ltr" value="{{ old('name') }}" class="w-2/3" required></x-text-input>
        <x-input-error :messages="$errors->first('name')" class="mt-2" />

        <div class="p-8">
        <x-primary-button class=" mt-4 bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
</x-admin-app-layout>

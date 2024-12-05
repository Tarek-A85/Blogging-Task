<x-admin-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Create new post') }}
        </h2>
    </x-slot>

    <form action="{{ route('post.store') }}" method="POST" class="p-8 border-slate-400 min-h-screen" enctype="multipart/form-data">
        @csrf
        <x-input-label class="text-xl font-semibold">{{ __('Title in English') }}<span class="text-red-600">*</span></x-input-label>
        <x-text-input name="title_en" class="w-2/3" value="{{old('title_en')}}" dir="ltr" required></x-text-input>
        <x-input-error :messages="$errors->first('title_en')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Content in English') }} <span class="text-red-600">*</span></x-input-label>
        <textarea name="content_en" id="" class="w-full" rows="10" dir="ltr" required>{{ old('content_en') }}</textarea>
        <x-input-error :messages="$errors->first('content_en')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Post type') }}<span class="text-red-600">*</span></x-input-label>
        <div class="flex items-center">
        @if($types->count())
        <select name="type_id">
            @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        @else
        <p class="text-lg font-bold text-red-500">{{ __('There is no types available') }}</p>
        @endif
        <a href="{{ route('type.create') }}" class="underline text-blue-500 hover:text-blue-400 mx-4">{{ __('Create new type') }}?</a>
        </div>

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Thumbnail') }}</x-input-label>
        <input type="file" name="thumbnail">
        <x-input-error :messages="$errors->first('thumbnail')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Title in Arablic') }}</x-input-label>
        <x-text-input class="w-2/3" name="title_ar" value="{{ old('title_ar') }}" dir="rtl"></x-text-input>
        <x-input-error :messages="$errors->first('title_ar')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Content in Arabic') }}</x-input-label>
        <textarea name="content_ar" id="" class="w-full" dir="rtl" rows="10">{{ old('content_ar') }}</textarea>
        <x-input-error :messages="$errors->first('content_ar')" class="mt-2" />

        <div class="flex justify-center items-center">
        <x-primary-button class=" mt-4 bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
   
</x-admin-app-layout>
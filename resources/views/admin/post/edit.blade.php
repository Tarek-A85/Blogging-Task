<x-admin-app-layout>

<x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Edit your post') }}
        </h2>
    </x-slot>

    <form action="{{ route('post.update', $post) }}" method="POST" class="p-8 border-slate-400 min-h-screen" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-input-label class="text-xl font-semibold">{{ __('Title in English') }}<span class="text-red-600">*</span></x-input-label>
        <x-text-input name="title_en" dir="ltr" value="{{ $post->title_en }}" class="w-2/3" required></x-text-input>
        <x-input-error :messages="$errors->first('title_en')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Content in English') }} <span class="text-red-600">*</span></x-input-label>
        <textarea name="content_en" class="w-full" dir="ltr" rows="10" required>{{ $post->content_en }}</textarea>
        <x-input-error :messages="$errors->first('content_en')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Post type') }}<span class="text-red-600">*</span></x-input-label>
        <div class="flex items-center">
        
        <select name="type_id">
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if($post->type_id === $type->id) 'selected' @endif>{{ $type->name }}</option>
            @endforeach
        </select>
        <a href="" class="underline text-blue-500 hover:text-blue-400 mx-4">{{ __('Create new type') }}?</a>
        </div>

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Thumbnail') }}</x-input-label>
        <input type="file" name="thumbnail">
        <x-input-error :messages="$errors->first('thumbnail')" class="mt-2" />
        @if(isset($post->thumbnail))
        <div class="mt-4">
            <p class="p-4 font-bold text-base text-sky-400">{{ __('Or') }}</p>
            <p> 
                <input type="checkbox" name="remove_image">
                {{ __('Remove current image') }}
            </p>
        </div>

        @endif

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Title in Arablic') }}</x-input-label>
        <x-text-input class="w-2/3" name="title_ar" dir="rtl" value="{{ $post->title_ar }}"></x-text-input>
        <x-input-error :messages="$errors->first('title_ar')" class="mt-2" />

        <x-input-label class="text-xl font-semibold mt-4">{{ __('Content in Arabic')}}</x-input-label>
        <textarea name="content_ar" id="" class="w-full" dir="rtl" rows="10">{{ $post->content_ar }}</textarea>
        <x-input-error :messages="$errors->first('content_ar')" class="mt-2" />

        <div class="flex justify-center items-center">
        <x-primary-button class=" mt-4 bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
   
</x-admin-app-layout>
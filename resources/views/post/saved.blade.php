<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Your Saved Posts') }}
        </h2>
    </x-slot>

    @forelse($saves as $save)
   
    <div class="rounded-lg p-8 mx-4 my-4 border border-slate-400 mt-8 w-1/4">
    <a href="{{ route('published_post_details', $save->post) }}">
    <h1 class="font-bold text-xl text-center">{{ app()->getLocale() === 'ar' && isset($save->post->title_ar) ? $save->post->title_ar : $save->post->title_en }}</h1>
    </a>
</div>
   
    <a href="{{ route('save_post', $save->post) }}">
    <p class="underline px-2 text-blue-500 hover:text-blue-400">{{ __('UnSave') }}</p>
        </a>
    @empty
    <p class="text-lg text-blue-500 p-8">{{ __('You don\'t have any saved posts') }}</p>

    @endforelse
</x-app-layout>

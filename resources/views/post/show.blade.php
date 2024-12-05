<x-app-layout>
   <div class="border-b border-blue-500 ">
   <h1 class="text-3xl  font-semibold mx-auto text-center py-8">{{ app()->getLocale() === 'ar' && isset($post->title_ar) ? $post->title_ar : $post->title_en }}
        <span class="bg-sky-400 text-white px-2 uppercase text-lg">{{$post->type->name}}</span>
    </h1>
    <div class="flex justify-center">
        @if(isset($post->thumbnail))
    <img src="/storage/{{$post->id}}/{{$post->thumbnail}}" class="h-96 w-2/3">
    @else
    <img src="https://images.pexels.com/photos/247791/pexels-photo-247791.png?auto=compress&cs=tinysrgb&w=600" alt="defaul" class="h-96 w-2/3">
    @endif
</div>
    <div class="container mx-auto text-xl py-8 px-4">
        <p class="mx-auto break-words">
        {{ app()->getLocale() === 'ar' && isset($post->content_ar) ? $post->content_ar : $post->content_en }}
        </p>
    </div>
    </div>
    <div class="mt-8 mb-8 flex justify-center items-center space-x-6">
    <a href="{{ route('like_post', $post) }}">   <span class="mx-2">  {{$post->likes_count}}  <i class="@if(!is_null($post->likes->where('user_id', auth()->id())->first())) fa-solid fa-thumbs-up @else fa-regular fa-thumbs-up @endif "></i> </span> </a>

<a href="{{ route('save_post', $post) }}">  <i class="@if(!is_null($post->saves->where('user_id', auth()->id())->first())) fa-solid fa-bookmark @else fa-regular fa-bookmark @endif"></i> </a>

    </div>
  
</x-app-layout>

<x-app-layout>
<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    
<form action="" class="flex justify-center items-center p-8">
<div class="rounded-lg flex relative items-center ml-52 w-2/3" >
    <x-text-input name="search" class="px-12 font-bold w-2/3 rounded-3xl" value="{{ request()->query('search') }}"  placeholder="{{ __('Search through all posts')}}"/>
    <i class="absolute @if(app()->getLocale() === 'ar') right-3 @else left-3 @endif fa-solid fa-magnifying-glass"></i>
    <x-primary-button class="bg-sky-400 hover:bg-sky-300 focus:bg-sky-300 active:bg-sky-300 mx-2">{{ __('Search') }}</x-primary-button>
</div>
</form>

    @if(isset($search))
    <p class="p-8 text-xl font-bold">{{ __('Showing search results for') }}: {{$search}}</p>
    @endif
    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 p-6 mt-4 ">
        @forelse($posts as $post)
        
        <div class="rounded-lg  max-w-sm ">
            <a href="{{ route('published_post_details', $post) }}">
            @if(isset($post->thumbnail))
            <div class="relative h-40 bg-center bg-cover" style="background-image: url('/storage/{{$post->id}}/{{$post->thumbnail}}');">
                @else
            <div class="relative h-40 bg-center bg-cover" style="background-image: url('https://images.pexels.com/photos/247791/pexels-photo-247791.png?auto=compress&cs=tinysrgb&w=600');">
                @endif
                <p class="absolute m-2 bg-sky-400 text-white px-2 uppercase">{{ $post->type->name }}</p>
            </div>

            <div class="container mx-auto mt-4">
            <h1 class="text-lg text-center font-bold ">{{ app()->getLocale() === 'ar' && isset($post->title_ar) ? $post->title_ar : $post->title_en }}</h1>
            </a>
            <div class="flex justify-between">
            <div><small>{{ __('published at') }} {{ $post->published_at->format('d-m-Y H:i') }}</small></div>
            <div class="space-x-4 "> 
           <a href="{{ route('like_post', $post) }}">   <span class="mx-2">  {{$post->likes_count}}  <i class="@if(!is_null($post->likes->where('user_id', auth()->id())->first())) fa-solid fa-thumbs-up @else fa-regular fa-thumbs-up @endif "></i> </span> </a>

              <a href="{{ route('save_post', $post) }}">  <i class="@if(!is_null($post->saves->where('user_id', auth()->id())->first())) fa-solid fa-bookmark @else fa-regular fa-bookmark @endif"></i> </a>
        </div>
            </div>
          
            
            </div>
            
        </div>
       
      
        @empty
        <p class="text-blue-400 font-bold text-lg">{{ __('There is no available posts') }}</p>

        @endforelse

    </div>

   <div class="p-6"> {{$posts->links()}} </div>
</body>
</x-app-layout>

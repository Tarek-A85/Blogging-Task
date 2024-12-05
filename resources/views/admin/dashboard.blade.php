<x-admin-app-layout>

@session('success')
<p class="text-xl text-white bg-green-500 text-center py-4">{{ session('success') }}</p>
@endsession

@session('error')
<p class="text-xl text-white bg-red-500 text-center py-4">{{ session('error') }}</p>
@endsession

<body dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<form action="" class=" flex justify-center items-center p-8">
<div class="rounded-lg flex relative items-center ml-52 w-2/3" >
    <x-text-input name="search" class="px-12 font-bold w-2/3 rounded-3xl" value="{{ request()->query('search') }}"  placeholder="{{ __('Search through all posts')}}"/>
    <i class="absolute @if(app()->getLocale() === 'ar') right-3 @else left-3 @endif fa-solid fa-magnifying-glass"></i>
    <x-primary-button class="bg-sky-400 hover:bg-sky-300 focus:bg-sky-300 active:bg-sky-300 mx-2">{{ __('Search') }}</x-primary-button>
</div>
</form>

<div class="p-8 flex items-center justify-between">
    <div>
        <p class="text-lg font-bold mx-2">{{ __('Or Filter By') }}: </p>
        <form action="">
        <select class="rounded-xl" name="filter" id="">
            <option value="All">{{ __('All') }}</option>
            <option value="published" @if(request()->query('filter') == 'published') selected @endif>{{ __('Published') }}</option>
            <option value="unpublished" @if(request()->query('filter') == 'unpublished') selected @endif>{{ __('Unpublished') }}</option>
        </select>
        <x-primary-button class="bg-sky-400 hover:bg-sky-300 focus:bg-sky-300 active:bg-sky-300 mx-2">{{ __('Apply') }}</x-primary-button>
        </form>
        </div>
        <div class="mx-4">
          <a href="{{ route('post.create') }}">  <x-primary-button class="bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">{{ __('Create new post') }}</x-primary-button></a>
        </div>
</div>

    @if(isset($search))
    <p class="p-8 text-xl font-bold">{{ __('Showing search results for') }}: {{$search}}</p>
    @endif
    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8 p-6 mt-4 ">
        @forelse($posts as $post)
        
        <div class="rounded-lg  max-w-sm ">
            <a href="{{ route('post.show', $post) }}">
            @if(isset($post->thumbnail))
            @if(!isset($post->published_at))
            <div class="relative h-40 bg-center bg-cover" style="background-image:url('/storage/posts/{{$post->id}}/{{$post->thumbnail}}');">
                @else
                <div class="relative h-40 bg-center bg-cover" style="background-image:url('/storage/{{$post->id}}/{{$post->thumbnail}}');">
            @endif
                @else
            <div class="relative h-40 bg-center bg-cover"  style="background-image: url('https://images.pexels.com/photos/247791/pexels-photo-247791.png?auto=compress&cs=tinysrgb&w=600');">
            @endif
            <p class="absolute m-2 bg-sky-400 text-white px-2 uppercase">{{$post->type->name}}</p>
            </div>

            <div class="container mx-auto mt-4">
            <h1 class="text-lg text-center font-bold ">{{ app()->getLocale() === 'ar' && isset($post->title_ar) ? $post->title_ar : $post->title_en }}</h1>
            </a>
            <div class="flex justify-between">
            <div><small>@if(isset($post->published_at)) {{ __('published at') }} {{$post->published_at->format('d-m-Y H:i') }}
                @else {{ __('created at')}} {{$post->created_at->format('d-m-Y H:i') }}
            @endif</small></div>
            <div class="space-x-4 mx-4"> 
                {{$post->likes_count}} <i class="fa-regular fa-thumbs-up"></i>
        </div>
            </div>
          
            
            </div>
        <div class="flex items-center mt-4 space-x-2">
       <a href="{{ route('post.edit', $post) }}"> <x-primary-button class="mx-2 bg-sky-600 hover:bg-sky-500 focus:bg-sky-500 active:bg-sky-500">{{ __('Edit') }}</x-primary-button> </a>
       <form action="{{ route('post.destroy', $post) }}" method="POST">
        @method('DELETE')
        @csrf
        <x-primary-button class="bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-500">{{ __('Delete') }}</x-primary-button>
        </form>
        @if( ! isset($post->published_at))
        <a href="{{ route('publish_post', $post) }}">
        @else
        <a href="{{ route('unpublish_post', $post) }}">
            @endif
        <x-primary-button class="{{$post->published_at ? 'bg-gray-600 hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-500'
                                                       : 'bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400'}}">
                                                      {{$post->published_at ? __('Unpublish') : __('publish') }} 
                                                    </x-primary-button> </a>
        </div>
        </div>
       
      
        @empty
        <p class="text-blue-400 font-bold text-lg">{{ __('There is no available posts') }}</p>

        @endforelse

    </div>

    {{$posts->links()}}
</body>

</x-admin-app-layout>

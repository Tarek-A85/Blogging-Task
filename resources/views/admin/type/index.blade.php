<x-admin-app-layout>


<div class="p-8">
    <a href="{{ route('type.create') }}">
        <x-primary-button class=" mt-4 bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">{{ __('Create new type') }}</x-primary-button>
        </a>
    </div>


@forelse($types as $type)

<div class="p-8 mx-4 my-4 rounded-lg border border-slate-400 w-1/3  text-center">
 <p class="text-lg font-bold">{{ $type->name }}</p>
 <p class="text-base font-bold">#{{ $type->posts_count }} {{ __('Posts') }}</p>
</div>
<div class="mb-8 flex items-center space-x-4 mx-2">
   <a href="{{ route('type.edit', $type) }}"> <x-primary-button class="mx-2 bg-sky-600 hover:bg-sky-500 focus:bg-sky-500 active:bg-sky-500">{{ __('Edit')}}</x-primary-button></a>
   <form action="{{ route('type.destroy', $type) }}" method="POST">
    @method('DELETE')
    @csrf
   <x-primary-button class="bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-500">{{ __('Delete')}}</x-primary-button>
   </form>
</div>

@empty

@endforelse

</x-admin-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex items-center">
                <p class="opacity-70">
                    <strong>Created: </strong>{{$note->created_at->diffForHumans()}}
                </p>
                <p class="opacity-70 ml-4">
                    <strong>Updated: </strong>{{$note->updated_at->diffForHumans()}}
                </p>
                <a href="{{ route('notes.edit',$note) }}" class="btn-link btn-lg ml-auto bg-blue-500 hover:bg-blue-700">Edit</a>
                <form action="{{ route('notes.destroy',$note) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn-link btn-lg ml-4 bg-red-500 hover:bg-red-700" onclick="return confirm('Are you sure want to delete this note?')">Delete</button>
                </form>
                
            </div>
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-5xl">
                        {{ $note->title }}
                    </h2>
                    <p class="mt-6 whitespace-pre-wrap">
                        {{ $note->description,200 }}
                    </p>
                </div>
        </div>
    </div>
</x-app-layout>

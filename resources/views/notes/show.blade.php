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
                    <strong>Created: </strong>{{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-4">
                    <strong>Updated: </strong>{{ $note->updated_at->diffForHumans() }}
                </p>
                @if ($note->user_id == $auth_id)
                    <a href="{{ route('notes.edit', $note) }}"
                        class="btn-link btn-lg ml-auto bg-blue-500 hover:bg-blue-700">Edit</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn-link btn-lg ml-4 bg-red-500 hover:bg-red-700"
                            onclick="return confirm('Are you sure want to delete this note?')">Delete</button>
                    </form>
                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                    </h2>
                    <x-user-profile :user='$note->user->name'/>
                </div>
                <p class="mt whitespace-pre-wrap text-md">
                    {{ $note->description, 200 }}
                </p>
                <div class="flex items-center gap-5">
                    <span class="flex items-center gap-2"><i class="fa fa-thumbs-o-up" aria-hidden="true" height="30px" width="30px"></i><p>like</p></span>
                    <span class="flex items-center gap-2">
                        <i class="fa fa-comments-o" aria-hidden="true"></i><p>markdown</p></span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

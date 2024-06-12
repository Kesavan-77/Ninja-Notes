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
                        class="btn-link btn-lg ml-auto bg-blue-800 hover:bg-blue-900">Edit</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn-link btn-lg ml-4 bg-red-600 hover:bg-red-700"
                            onclick="return confirm('Are you sure want to delete this note?')">Delete</button>
                    </form>
                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-2xl text-blue-800">
                        <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                    </h2>
                    <x-user-profile :user='$note->user->name' />
                </div>
                <p class="mt whitespace-pre-wrap text-md">
                    {{ $note->description, 200 }}
                </p>
                <p class="hidden" id="note-id">{{ $note->id }}</p>
                <div class="flex items-center gap-5">
                    <span class="flex items-center gap-2 cursor-pointer" id="like-btn">
                        <p id="like-count"></p><i class="fa fa-thumbs-o-up" aria-hidden="true" height="30px"
                            width="30px"></i>
                        <p>like</p>
                    </span>
                    <span class="flex items-center gap-2 cursor-pointer" id="markdown-btn"><i class="fa fa-comments-o"
                            aria-hidden="true"></i>
                        <p>markdown</p>
                    </span>
                </div>
            </div>

            <!--------Markdown form-------->

            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg hidden"
                id="markdown-container">
                <form method="POST" action="{{ route('markdown.store') }}" id="markdown-form">
                    @csrf
                    <div>
                        <x-input-label for="markdown" :value="__('Markdown')" />
                        <x-text-input id="markdown" class="block mt-1 w-full" type="text" name="markdown"
                            :value="old('markdown')" required autofocus autocomplete="message" />
                        <x-input-error :messages="$errors->get('markdown')" class="mt-2" />
                        <x-text-input type="hidden" name="noteId" :value="$note->id" required autofocus
                            autocomplete="message" />
                    </div>
                    <div class="flex items-center mt-4">
                        <x-primary-button>
                            {{ __('submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-----markdowns container------->
            <div>
                <h2 class="font-bold text-lg ml-2">Markdowns:</h2>
                @forelse($markdown as $mark)
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <div class="flex items-center justify-between">
                            <p class="mt-2 text-sm opacity-50">
                                @ {{ $mark->user->name }}
                            </p>
                            @if ($mark->user->id == Auth::id())
                                <div class="flex gap-3 items-center">
                                    <a href="{{ route('markdown.edit', $mark) }}"
                                        class="text-sm opacity-70 cursor-pointer">Edit</a>
                                    <form method="POST" action="{{ route('markdown.destroy', $mark) }}">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="text-sm opacity-70 cursor-pointer" value="Delete">
                                    </form>
                                </div>
                            @endif
                        </div>
                        <p class="mt-2 text-md">
                            {{ Str::limit($mark->markdown, 200) }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $mark->updated_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="mt-2">
                        No markdown found
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!---------- Search bar ----------->
                <div class="mb-5">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="search-note" class="block w-full p-4 ps-10 text-sm rounded-lg" placeholder="Search for notes" required />
                </div>
            <!----------end search bar---------->

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2 bg-blue-800">+ New Note</a>
            @endif
            <p id="note-result"></p>
            <div class="flex flex-wrap w-full gap-3 items-center" id="note-container">
                @forelse($notes as $note)
                    <div class="my-3 min-w-sm p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg" >
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-bold text-2xl text-blue-800">
                                <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                            </h2>
                            <x-user-profile :user='$note->user->name' />
                        </div>
                        <p class="mt-2 text-md">
                            {{ Str::limit($note->description, 200) }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="mt-2">
                        No notes found
                    </p>
                @endforelse
            </div>
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>

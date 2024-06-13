<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search bar -->
            <div class="relative mb-5">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search-note"
                    class="block w-full py-3 pl-10 pr-4 text-sm rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500"
                    placeholder="Search for notes" required>
            </div>
            <!-- End search bar -->

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            
            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}"
                    class="inline-block px-4 py-2 mb-4 text-sm font-semibold leading-5 text-white bg-blue-800 rounded-lg hover:bg-blue-900">
                    + New Note
                </a>
            @endif

            <div id="note-result"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="note-container">
                @forelse ($notes as $note)
                    <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between mb-2">
                                <h2 class="text-lg font-semibold text-blue-800">
                                    <a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a>
                                </h2>
                                <x-user-profile :user="$note->user->name" />
                            </div>
                            <p class="text-gray-700">{{ Str::limit($note->description, 150) }}</p>
                        </div>
                        <div class="px-6 py-2 mt-auto">
                            <p class="text-xs text-gray-500">{{ $note->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-lg text-gray-700">No notes found</p>
                @endforelse
            </div>

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>

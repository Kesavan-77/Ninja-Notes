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
            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2 bg-blue-800">+ New Note</a>
            @endif
            <div class="flex flex-wrap w-full gap-3 items-center">
                @forelse($notes as $note)
                    <div class="my-3 max-w-xl min-w-sm p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
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

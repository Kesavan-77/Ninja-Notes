<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">+ New Note</a>
            @endif
            @forelse($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{ $note->title }}
                    </h2>
                    <p class="mt-2">
                        {{ Str::limit($note->description,200) }}
                    </p>
                    <span
                        class="block mt-4 text-sm opacity-70">{{ \Carbon\Carbon::now()->diffForHumans($note->updated_at) }}</span>
                </div>
            @empty
                <p class="mt-2">
                    No notes found
                </p>
            @endforelse
            {{$notes->links()}}
        </div>
    </div>
</x-app-layout>

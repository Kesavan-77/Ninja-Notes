<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($notes as $note)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{$note->title}}
                </h2>
                <p class="mt-2">
                    {{$note->description}}
                </p>
                <span class="block mt-4 text-sm opacity-70">{{ \Carbon\Carbon::now()->diffForHumans($note->updated_at) }}</span>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

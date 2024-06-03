<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created: </strong>{{$note->created_at->diffForHumans()}}
                </p>
                <p class="opacity-70 ml-4">
                    <strong>Updated: </strong>{{$note->updated_at->diffForHumans()}}
                </p>
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

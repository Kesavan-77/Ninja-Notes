<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <!--------Markdown form-------->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6  p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg" id="markdown-container">
                <form method="POST" action="{{ route('markdown.update', $markdown) }}" id="markdown-form">
                    @method('PUT')
                    @csrf
                    <div>
                        <x-input-label for="markdown" :value="__('Markdown')" />
                        <x-text-input id="markdown" class="block mt-1 w-full" type="text" name="markdown"
                            :value="@old('title',$markdown->markdown)" required autofocus autocomplete="message" />
                        <x-input-error :messages="$errors->get('markdown')" class="mt-2" />
                        <x-text-input type="hidden" name="noteId" :value="$markdown->id" required autofocus
                            autocomplete="message" />
                    </div>
                    <div class="flex items-center mt-4">
                        <x-primary-button>
                            {{ __('submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

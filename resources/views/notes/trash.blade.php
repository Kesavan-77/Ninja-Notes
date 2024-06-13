<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trash') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            @forelse($trashs as $trash)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-3xl">
                            {{ $trash->title }}
                        </h2>
                        <x-user-profile :user='$trash->user->name'/>
                    </div>
                    <p class="mt-2 text-md">
                        {{ Str::limit($trash->description, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $trash->updated_at->diffForHumans() }}</span>

                    <div class="flex mt-2">
                        <form action="{{ route('trash.restore', $trash->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn-link btn-lg bg-blue-800 hover:bg-blue-900">Restore</button>
                        </form>

                        <form action="{{ route('trash.destroy', $trash->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn-link btn-lg ml-4 bg-red-700 hover:bg-red-800"
                                onclick="return confirm('Are you sure want to delete this note?')">Delete
                                Permanently</button>
                        </form>
                    </div>

                </div>
            @empty
                <p class="mt-2">
                    No notes found
                </p>
            @endforelse
            {{ $trashs->links() }}
        </div>
    </div>
</x-app-layout>

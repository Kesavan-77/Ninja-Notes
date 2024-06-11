<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse($notifications as $notification)
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-md text-blue-800">
                                    {{ $notification->data['name'] }}
                                </p>
                                <p class="text-md">
                                    {{ $notification->data['message'] }}
                                </p>
                                <p class="ml-3 text-md text-blue-400">
                                    {{ $notification->read_at?"":"new notification" }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm opacity-50">
                                    {{ $notification->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
            @empty
                <p class="mt-2">
                    No notifications found
                </p>
            @endforelse
            {{auth()->user()->notifications->where('notifiable_id',Auth::id())->markAsRead();}}
        </div>
    </div>
</x-app-layout>

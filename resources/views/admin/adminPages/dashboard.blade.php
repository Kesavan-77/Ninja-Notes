<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .hover-row {
        transition: background-color 0.3s, transform 0.3s;
    }
    .hover-row:hover {
        background-color: #f3f4f6;
    }
    .delete-btn {
        transition: color 0.3s, transform 0.3s;
    }
    .delete-btn:hover {
        color: #ff4d4d;
        transform: scale(1.1);
    }
    .icon {
        width: 1rem;
        height: 1rem;
        margin-right: 0.25rem;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-blue-800 shadow">
            <nav x-data="{ open: false }" class="bg-blue-900 text-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="shrink-0 flex items-center">
                                <a href="dashboard">
                                    <h1 class="text-2xl font-bold">Ninja Notes</h1>
                                </a>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <p class="font-bold text-md">{{ Auth::user()->name }}'s Dashboard</p>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('admin.logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="bg-gray-50 min-h-screen py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-lg rounded-xl">
                    <table class="w-full text-sm text-left text-gray-800 bg-white rounded-xl overflow-hidden">
                        <thead class="text-xs uppercase bg-gradient-to-r from-blue-800 to-indigo-800 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4">User name</th>
                                <th scope="col" class="px-6 py-4">Total Notes</th>
                                <th scope="col" class="px-6 py-4">Total Likes</th>
                                <th scope="col" class="px-6 py-4">Total markdowns</th>
                                <th scope="col" class="px-6 py-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($users); $i++)
                                <tr class="bg-white border-b hover-row h-20">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                        {{ $users[$i]->name }}</th>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">{{ count($notes[$i]->notes) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-yellow-100 text-yellow-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">{{ count($likes[$i]->likes) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-red-100 text-red-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">{{ count($markdowns[$i]->markdowns) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="delete-btn flex items-center justify-center font-medium text-red-600">
                                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Delete User
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>
</body>

</html>

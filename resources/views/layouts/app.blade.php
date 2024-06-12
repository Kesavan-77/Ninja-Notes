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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<script>
    $(document).ready(function() {

        // Cache frequently used elements
        var $markdownContainer = $('#markdown-container');
        var $likeCount = $('#like-count');
        var $searchNote = $('#search-note');
        var $noteContainer = $('#note-container');

        // Toggle the markdown container
        $('#markdown-btn').on('click', function() {
            $markdownContainer.toggle();
        });

        // CSRF token setup for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get the note ID
        var id = $('#note-id').text().trim();

        // Fetch and update the like count
        function updateLikeCount() {
            $.ajax({
                type: 'GET',
                url: '{{ route('likes.count') }}',
                data: {
                    noteId: id
                },
                success: function(data) {
                    $likeCount.text(data);
                },
                error: function(xhr) {
                    console.error('Error fetching like count:', xhr);
                    alert('An error occurred while fetching the like count. Please try again.');
                }
            });
        }

        // Initial call to update like count
        updateLikeCount();

        // Like button click handler
        $('#like-btn').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('likes.manage') }}',
                data: {
                    noteId: id
                },
                success: function(data) {
                    $likeCount.text(data);
                },
                error: function(xhr) {
                    console.error('Error managing like:', xhr);
                    alert('An error occurred while managing the like. Please try again.');
                }
            });
        });

        // Search note keyup handler
        $searchNote.on('keyup', function() {
            var search = $searchNote.val();
            $.ajax({
                type: 'POST',
                url: '{{ route('search-note') }}',
                data: {
                    search: search,
                },
                success: function(data) {
                    var res = '';
                    data.forEach(note => {
                        res += `
            <div class="my-3 min-w-sm p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-2xl text-blue-800">
                        <a href="/notes/${note.uuid}">${note.title}</a>
                    </h2>
                    <x-user-profile :user="'${note.user.name}'" />
                </div>
                <p class="mt-2 text-md">
                    ${note.description.length > 200 ? note.description.substring(0, 200) + '...' : note.description}
                </p>
                <span class="block mt-4 text-sm opacity-70">${new Date(note.updated_at).toLocaleString()}</span>
            </div>`;
                    });
                    $noteContainer.html(res);
                },
                error: function(xhr) {
                    console.error('Error during search:', xhr);
                    alert(
                        'An error occurred while performing the search. Please try again.');
                }
            });
        });

    });
</script>


</html>

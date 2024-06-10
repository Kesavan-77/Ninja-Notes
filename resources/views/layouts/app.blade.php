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

        // Toggle the markdown container
        $('#markdown-btn').on('click', function() {
            $('#markdown-container').toggle();
        });

        // $('#markdown-form').on('submit',function(){
        //     let markdown = $('#markdown').val();

        // });

        // CSRF token setup for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Get the note ID
        var id = $('#note-id').text().trim();

        // Fetch the like count
        $.ajax({
            type: 'GET',
            url: '{{ route('likes.count') }}',
            data: {
                noteId: id
            },
            success: function(data) {
                let likeCount = data;
                $('#like-count').text(likeCount);
            },
            error: function(xhr) {
                console.error('Error fetching like count:', xhr);
                alert('An error occurred while fetching the like count. Please try again.');
            }
        });

        $('#like-btn').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('likes.manage') }}',
                data: {
                    noteId: id
                },
                success: function(data) {
                    let likeCount = data;
                    $('#like-count').text(likeCount);
                },
                error: function(xhr) {
                    console.error('Error managing like:', xhr);
                    alert('An error occurred while managing the like. Please try again.');
                }
            });
        });
    });
</script>


</html>
